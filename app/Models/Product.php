<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'sku',
        'name',
        'name_s_ch',
        'name_t_ch',
        'abbreviation',
        'product_picture',
        'pricing_type',
        'fixed_amount',
        'promo_amount',
        'buy_bank_amount',
        'surcharge_at_product',
        'description',
        'description_s_ch',
        'description_t_ch',
        'catergory_id',
        'manufacturer_id',
        'weight',
        'weight_in_grams',
        'weight_unit',
        'mark_up',
        'valid_from',
        'valid_till',
        'status',
        'session_duration',
        'markup_type',
        'on_hold',
        'tier_commission_1',
        'tier_commission_2',
        'tier_commission_3',
        'tier_commission_4',
        'tier_commission_5',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
        'valid_from',
        'valid_till',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
        'updated_at' => 'date:d M, Y H:i',
        'valid_from' => 'date:d M, Y H:i',
        'valid_till' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'product_picture_url',
        'product_price',
    ];

    public function category()
    {
        return $this->belongsTo(Catergory::class, 'catergory_id', 'id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public function customer_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }

    public function product_commissions()
    {
        return $this->hasMany(ProductCommission::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function getProductPictureUrlAttribute()
    {
        $image = asset('frontend/images/shop/product-placeholder.jpg');

        if (!empty($this->product_picture) && file_exists('uploads/products/' . $this->product_picture)) {
            $image = asset('uploads/products/' . $this->product_picture);
        }

        return $image;
    }

    public function getProductPriceAttribute()
    {
        $product = $this;
        $final_price = 0;

        // return 'N/A';

        if ($product->pricing_type == 'fix_price') {
            if ($product->surcharge_at_product == 'yes') {
                if ($product->markup_type == 'flat') {
                    $final_price = $product->mark_up + $product->fixed_amount;
                } else {
                    $final_price = $product->fixed_amount + (($product->fixed_amount / 100) * $product->mark_up);
                }
            } else {
                if ($product->category->surcharge_at_category == 'yes') {
                    if ($product->category->mark_up == 'flat') {
                        $final_price = $product->mark_up + $product->fixed_amount;
                    } else {
                        $final_price = $product->fixed_amount + (($product->fixed_amount / 100) * $product->category->mark_up);
                    }
                } else {
                    $final_price = $product->fixed_amount;
                }
                // $product->category->mark_up;
                // $final_price = $product->fixed_amount;
            }
        } else {
            try {
                $gold_price = 0;
                if (Session::get('gold_price') && Carbon::now()->timestamp < Session::get('gold_price_expires_at')) {
                    $gold_price = Session::get('gold_price');
                } else {
                    // $response = Http::get('http://150.242.218.15:3080/');
                    // $resp = $response->object();
                    // $gold_price = $resp->ask;
                    $gold_price = 1747;

                    Session::put('gold_price', $gold_price);
                    Session::put('gold_price_expires_at', Carbon::now()->addMinutes(10)->timestamp);
                }

                $price = ($product->weight * $gold_price);
                if ($product->surcharge_at_product == 'yes') {
                    if ($product->markup_type == 'flat') {
                        $final_price = $product->mark_up + $price;
                    } else {
                        $final_price = $price + (($price / 100) * $product->mark_up);
                    }
                } else {
                    if ($product->category->surcharge_at_category == 'yes') {
                        if ($product->category->mark_up == 'flat') {
                            $final_price = $product->mark_up + $price;
                        } else {
                            $final_price = $price + (($price / 100) * $product->category->mark_up);
                        }
                    } else {
                        $final_price = $price;
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
                return 'N/A';
            }
        }

        return $final_price;
    }

    public function getProductPriceWithoutMarkUp()
    {
        $product = $this;
        $final_price = 0;

        // return 'N/A';

        if ($product->pricing_type == 'fix_price') {
            $final_price = $product->fixed_amount;
        } else {
            try {
                $gold_price = 0;
                if (Session::get('gold_price') && Carbon::now()->timestamp < Session::get('gold_price_expires_at')) {
                    $gold_price = Session::get('gold_price');
                } else {
                    // $response = Http::get('http://150.242.218.15:3080/');
                    // $resp = $response->object();
                    // $gold_price = $resp->ask;
                    $gold_price = 1747;
                    Session::put('gold_price', $gold_price);
                    Session::put('gold_price_expires_at', Carbon::now()->addMinutes(10)->timestamp);
                }
                $final_price = ($product->weight * $gold_price);
            } catch (\Throwable $th) {
                //throw $th;
                return 'N/A';
            }
        }
        return $final_price;
    }

    public function getProductPrice($type = 'str')
    {
        $product = $this;
        $final_price = 0;

        // return 'N/A';

        if ($product->pricing_type == 'fix_price') {
            if ($product->surcharge_at_product == 'yes') {
                if ($product->markup_type == 'flat') {
                    $final_price = $product->mark_up + $product->fixed_amount;
                } else {
                    $final_price = $product->fixed_amount + (($product->fixed_amount / 100) * $product->mark_up);
                }
            } else {
                if ($product->category->surcharge_at_category == 'yes') {
                    if ($product->category->mark_up == 'flat') {
                        $final_price = $product->mark_up + $product->fixed_amount;
                    } else {
                        $final_price = $product->fixed_amount + (($product->fixed_amount / 100) * $product->category->mark_up);
                    }
                } else {
                    $final_price = $product->fixed_amount;
                }
                // $product->category->mark_up;
                // $final_price = $product->fixed_amount;
            }
        } else {
            try {
                $gold_price = 0;
                if (Session::get('gold_price') && Carbon::now()->timestamp < Session::get('gold_price_expires_at')) {
                    $gold_price = Session::get('gold_price');
                } else {
                    // $response = Http::get('http://150.242.218.15:3080/');
                    // $resp = $response->object();
                    // $gold_price = $resp->ask;
                    $gold_price = 1747;

                    Session::put('gold_price', $gold_price);
                    Session::put('gold_price_expires_at', Carbon::now()->addMinutes(10)->timestamp);
                }

                $price = ($product->weight * $gold_price);
                if ($product->surcharge_at_product == 'yes') {
                    if ($product->markup_type == 'flat') {
                        $final_price = $product->mark_up + $price;
                    } else {
                        $final_price = $price + (($price / 100) * $product->mark_up);
                    }
                } else {
                    if ($product->category->surcharge_at_category == 'yes') {
                        if ($product->category->mark_up == 'flat') {
                            $final_price = $product->mark_up + $price;
                        } else {
                            $final_price = $price + (($price / 100) * $product->category->mark_up);
                        }
                    } else {
                        $final_price = $price;
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
                return 'N/A';
            }
        }

        if ($type == 'str') {
            return  'USD ' . number_format($final_price, 2);
        }

        return $final_price;
    }

    public function getProductCommission()
    {
        if (isset($this->mark_up)) {
            if ($this->markup_type == 'flat') {
                return $this->mark_up;
            } else {
                $price = $this->getProductPriceWithoutMarkUp();
                if (gettype($price) == 'double') {
                    $percentage = ($price / 100) * $this->mark_up;
                    return $percentage;
                }
            }
        } else {
            if (isset($this->category->mark_up)) {
                $final_price = 0;
                if ($this->category->mark_up == 'flat') {
                    $final_price = $this->mark_up;
                } else {
                    $price = $this->getProductPriceWithoutMarkUp();
                    if (gettype($price) == 'double') {
                        $final_price = ($price / 100) * $this->mark_up;
                    }
                }
                return $final_price;
            } else {
                return null;
            }
        }
    }

    public function productsInventory($quantity)
    {
        $inventory = Inventory::where('product_id', $this->id)->sum('units');
        // dd($inventory);
        if ($inventory > 0) {
            if ($inventory > $quantity) {
                return $inventory;
            }
        }
        return null;
    }

    public function productsQuantity()
    {
        $inventory = Inventory::where('product_id', $this->id)->sum('units');
        // dd($inventory);
        if ($inventory > 0) {
            return $inventory;
        }
        return null;
    }
}
