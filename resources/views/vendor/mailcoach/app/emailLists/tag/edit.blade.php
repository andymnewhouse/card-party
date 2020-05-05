@extends('mailcoach::app.emailLists.layouts.tag', ['tag' => $tag])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href="{{ route('mailcoach.emailLists') }}">
                    <span class="breadcrumb">Lists</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mailcoach.emailLists.tags', $tag->emailList) }}">
                    <span class="breadcrumb">{{ $tag->emailList->name }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mailcoach.emailLists.tags', $emailList) }}">
                    <span class="breadcrumb">Tags</span>
                </a>
            </li>
            <li>
                <span class="breadcrumb">{{ $tag->name }}</span>
            </li>
        </ul>
    </nav>
@endsection

@section('tag')
        <form
            class="form-grid"
            action="{{ route('mailcoach.emailLists.tag.edit', [$emailList, $tag]) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <x-text-field label="Name" name="name" :value="$tag->name" required />

            <div class="form-buttons">
                <button type="submit" class="button">
                    <x-icon-label icon="fa-tag" text="Save tag" />
                </button>
            </div>
        </form>
@endsection
