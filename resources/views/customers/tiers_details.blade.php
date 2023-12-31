@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Customer Tiers</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul id="tree1">
                        @foreach ($users as $user)
                            <li>
                                {{ $user->name }}
                                @if (count($user->child))
                                    @include('customers.manageAgentChilds', ['childs' => $user->child])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('header_scripts')
    <style>
        .tree,
        .tree ul {
            margin: 0;
            padding: 0;
            list-style: none
        }

        .tree ul {
            margin-left: 1em;
            position: relative
        }

        .tree ul ul {
            margin-left: .5em
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 10px;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0
        }

        .indicator {
            margin-right: 5px;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button,
        .tree li button:active,
        .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }
    </style>
@endpush

@push('footer_scripts')
    <script>
        $(document).ready(function() {
            $.fn.extend({
                treed: function(o) {

                    var openedClass = 'glyphicon-minus-sign';
                    var closedClass = 'glyphicon-plus-sign';

                    if (typeof o != 'undefined') {
                        if (typeof o.openedClass != 'undefined') {
                            openedClass = o.openedClass;
                        }
                        if (typeof o.closedClass != 'undefined') {
                            closedClass = o.closedClass;
                        }
                    };

                    /* initialize each of the top levels */
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function() {
                        var branch = $(this);
                        branch.prepend("");
                        branch.addClass('branch');
                        branch.on('click', function(e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        branch.children().children().toggle();
                    });
                    /* fire event from the dynamically added icon */
                    tree.find('.branch .indicator').each(function() {
                        $(this).on('click', function() {
                            $(this).closest('li').click();
                        });
                    });
                    /* fire event to open branch if the li contains an anchor instead of text */
                    tree.find('.branch>a').each(function() {
                        $(this).on('click', function(e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                    /* fire event to open branch if the li contains a button instead of text */
                    tree.find('.branch>button').each(function() {
                        $(this).on('click', function(e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                }
            });
            /* Initialization of treeviews */
            $('#tree1').treed();
        });
    </script>
@endpush
