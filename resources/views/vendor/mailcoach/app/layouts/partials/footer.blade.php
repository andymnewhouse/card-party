<div class="flex flex-wrap items-center justify-center pt-8 text-gray-400 text-xs">
    <a class="link-dimmed" href="https://mailcoach.app/docs" target="_blank">Documentation</a>
    <span class="mx-2">•</span>
    <a class="link-dimmed inline-block truncate" style="max-width: 12rem" href="https://mailcoach.app">
        Mailcoach {{ $versionInfo->getCurrentVersion() }}
    </a>
    <span>&nbsp;by <a class="link-dimmed" href="https://spatie.be">SPATIE</a></span>

    @if(! $versionInfo->isLatest())
        <a class="ml-4 my-2 inline-flex items-center bg-green-200 text-green-800 rounded-sm px-2 leading-loose" href="/">
            <i class="fas fa-horse-head opacity-50 mr-1"></i>
            Upgrade available
        </a>
    @endif
</div>
