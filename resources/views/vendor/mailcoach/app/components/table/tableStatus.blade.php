<p class="table-status">
    Displaying {{ $paginator->count() }} of {{ $totalCount }} {{ Illuminate\Support\Str::plural($name) }}.
    @if($paginator->total() !== $totalCount)
        <a href="{{ $showAllUrl }}" class="link-dimmed" data-turbolinks="false">
            Show all
        </a>
    @endif
</p>

{{ $paginator->appends(request()->input())->links() }}
