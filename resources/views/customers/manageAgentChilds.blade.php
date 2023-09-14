<ul>
    {{-- {{ dd($childs->toArray()) }} --}}
    @foreach ($childs as $child)
        <li>
            {{ $child->name }}
            @if (count($child->child))
                @include('customers.manageAgentChilds', ['childs' => $child->child])
            @endif
        </li>
    @endforeach
</ul>
