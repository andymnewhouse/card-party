@extends('mailcoach::app.layouts.app', ['title' => 'Templates'])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li><span class="breadcrumb">Templates</span></li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card">
        <div class="table-actions">
            <button class="button" data-modal-trigger="create-template">
                <x-icon-label icon="fa-clipboard" text="Create template"/>
            </button>

            <x-modal title="Create template" name="create-template" :open="$errors->any()">
                @include('mailcoach::app.templates.partials.create')
            </x-modal>

            @if($templates->count() || $searching)
                <div class="table-filters">
                    <x-search placeholder="Filter templates…"/>
                </div>
            @endif
        </div>

        @if($templates->count())
            <table class="table table-fixed">
                <thead>
                <tr>
                    <x-th sort-by="name" sort-default>Name</x-th>
                    <x-th sort-by="-updated_at" class="w-48 th-numeric">Last updated</x-th>
                    <th class="w-12"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($templates as $template)
                    <tr>
                        <td class="markup-links">
                            <a class="break-words" href="{{ route('mailcoach.templates.edit', $template) }}">
                                {{ $template->name }}
                            </a>
                        </td>
                        <td class="td-numeric">{{ $template->updated_at->toMailcoachFormat() }}</td>
                        <td class="td-action">
                            <div class="dropdown" data-dropdown>
                                <button class="icon-button" data-dropdown-trigger>
                                    <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                                </button>
                                <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                    <li>
                                        <x-form-button
                                            :action="route('mailcoach.templates.duplicate', $template)"
                                        >
                                            <x-icon-label icon="fa-random" text="Duplicate" />
                                        </x-form-button>
                                    </li>
                                    <li>
                                        <x-form-button
                                            :action="route('mailcoach.templates.delete', $template)"
                                            method="DELETE"
                                            data-confirm="true"
                                            :data-confirm-text="'Are you sure you want to delete template ' . $template->name . '?'"
                                        >
                                            <x-icon-label icon="fa-trash-alt" text="Delete" :caution="true" />
                                        </x-form-button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <x-table-status
                name="template"
                :paginator="$templates"
                :total-count="$totalTemplatesCount"
                :show-all-url="route('mailcoach.templates')"
            ></x-table-status>

        @else
            <p class="alert alert-info">
                @if ($searching)
                    No templates found.
                @else
                    DRY? No templates here.
                @endif
            </p>
        @endif
    </section>
@endsection
