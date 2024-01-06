{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex" style="background-image: url({{ asset('images/Logo-for-Chat-icon.jpg') }})"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    @php
        $is_staff = auth()->user()->userable_type === \App\Models\Staff::class;
    @endphp
    @if ($is_staff)
        <a href="#" class="danger delete-conversation">Delete Conversation</a>
    @endif
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div>
