@extends('mailcoach::app.layouts.app', ['title' => 'Import subscribers | ' . $emailList->name])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li><a href="{{ route('mailcoach.emailLists') }}"><span class="breadcrumb">Lists</span></a></li>
            <li><a href="{{ route('mailcoach.emailLists.subscribers', [$emailList]) }}"><span class="breadcrumb">{{ $emailList->name }}</span></a></li>
            <li><span class="breadcrumb">Import subscribers</span></li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card">
        @if (count($subscriberImports))
            <table class="table table-fixed mb-12">
                <thead>
                <tr>
                    <th class="w-32">Status</th>
                    <th class="w-48 th-numeric">Started at</th>
                    <th>List</th>
                    <th class="w-32 th-numeric">Imported subscribers</th>
                    <th class="w-32 th-numeric">Errors</th>
                    <th class="w-12"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriberImports as $subscriberImport)
                    <tr>
                        <td>
                            @switch($subscriberImport->status)
                                @case(\Spatie\Mailcoach\Enums\SubscriberImportStatus::PENDING)
                                <i title="Scheduled" class="far fa-clock text-orange-500`"></i>
                                @break
                                @case(\Spatie\Mailcoach\Enums\SubscriberImportStatus::IMPORTING)
                                <i title="Importing" class="fas fa-sync fa-spin text-blue-500"></i>
                                @break
                                @case(\Spatie\Mailcoach\Enums\SubscriberImportStatus::COMPLETED)
                                <i title="Completed" class="fas fa-check text-green-500"></i>
                                @break
                            @endswitch
                        </td>
                        <td class="td-numeric">
                            {{ $subscriberImport->created_at->toMailcoachFormat() }}
                        </td>
                        <td>{{ $subscriberImport->emailList->name }}</td>
                        <td class="td-numeric">{{ $subscriberImport->imported_subscribers_count }}</td>
                        <td class="td-numeric">{{ $subscriberImport->error_count }}</td>
                        <td class="td-action">
                            <div class="dropdown" data-dropdown>
                                <button class="icon-button" data-dropdown-trigger>
                                    <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                                </button>
                                <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                    <li>
                                        <a href="{{ $subscriberImport->getImportedSubscribersReportUrl() }}">
                                            <x-icon-label icon="fa-list" text="Import report"/>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $subscriberImport->getErrorReportUrl() }}">
                                            <x-icon-label icon="fa-exclamation-triangle" text="Error report"/>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $subscriberImport->getImportFileUrl() }}">
                                            <x-icon-label icon="fa-file-upload" text="Uploaded file"/>
                                        </a>
                                    </li>
                                    <li>
                                        <x-form-button
                                            :action="route('mailcoach.subscriberImport.delete', $subscriberImport->id)"
                                            method="DELETE" class="link-delete">
                                            <x-icon-label icon="fa-trash-alt" text="Delete" :caution="true"/>
                                        </x-form-button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <form class="flex" enctype="multipart/form-data" method="POST"
              action="{{ route('mailcoach.emailLists.import-subscribers', $emailList) }}">
            @csrf

            <div class=button>
                <button class="font-semibold h-10" type="submit">
                    <x-icon-label icon="fa-cloud-upload-alt" text="Import subscribers"/>
                </button>
                <input onchange="this.form.submit();" class="absolute inset-0 opacity-0 text-4xl" accept=".csv, .xlsx" type="file" id="file"
                       name="file" class="w-48 h-10"/>
            </div>

            @error('file')
            <p class="form-error">{{ $message }}</p>
            @enderror


        </form>

        <p class="alert alert-info mt-6">
            Upload a CSV file with these columns: email, first_name, last_name, tags <a href="https://mailcoach.app/docs/v2/app/lists/subscribers#importing-subscribers" target="_blank">(see documentation)</a>
        </p>
    </section>
@endsection
