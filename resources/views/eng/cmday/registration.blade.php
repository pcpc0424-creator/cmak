@php $page = eng_page('cmday/registration'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'CM Day Registration') . ' - CMAK')
@section('hero', true)
@section('category', 'International CM Day')
@section('category-link', '/cmak/eng/cmday/introduction')
@section('page-title', $page->title ?? 'Registration')
@section('side-menu')
    @include('eng.cmday._side')
@endsection

@push('styles')
<style>
.eng-form { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 18px; }
.eng-form .full { grid-column: 1 / -1; }
.eng-form label { display: block; font-size: 13px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
.eng-form input, .eng-form select, .eng-form textarea {
    width: 100%; padding: 12px 14px; font-size: 14px;
    border: 1px solid #dde3ed; border-radius: 8px;
    background: #fff; color: #1a1a1a;
    transition: all 0.2s;
    font-family: inherit;
}
.eng-form input:focus, .eng-form select:focus, .eng-form textarea:focus {
    outline: none; border-color: #0061c2; box-shadow: 0 0 0 3px rgba(0,97,194,0.12);
}
.eng-form textarea { resize: vertical; min-height: 100px; }
.eng-form-submit {
    margin-top: 24px;
    padding: 14px 36px;
    background: linear-gradient(135deg, #0a3d7c, #0061c2);
    color: #fff;
    border: none;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 0.5px;
    transition: all 0.25s;
}
.eng-form-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(10,61,124,0.25); }
@media (max-width: 700px) { .eng-form { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Registration' }}</h2>
    <p class="desc">{{ $page->description ?? 'Register to attend International CM Day in Korea.' }}</p>

    <p>Thank you for your interest in joining International CM Day celebrations. Please complete the registration form below and our secretariat will follow up with confirmation and further details.</p>

    <div class="eng-info-box">
        <dt>Event</dt><dd>International CM Day &mdash; Korea Celebration</dd>
        <dt>Venue</dt><dd>To be announced</dd>
        <dt>Registration Fee</dt><dd>Free for CMAK members; standard fee applies for non-members</dd>
        <dt>Inquiries</dt><dd>cmak@cmak.or.kr / +82-2-585-4712</dd>
    </div>

    <h3>Registration Form</h3>
    <form class="eng-form" onsubmit="event.preventDefault(); alert('Thank you for registering. The secretariat will contact you shortly.');">
        <div>
            <label>First Name *</label>
            <input type="text" required>
        </div>
        <div>
            <label>Last Name *</label>
            <input type="text" required>
        </div>
        <div>
            <label>Email *</label>
            <input type="email" required>
        </div>
        <div>
            <label>Phone</label>
            <input type="tel">
        </div>
        <div>
            <label>Organization *</label>
            <input type="text" required>
        </div>
        <div>
            <label>Position / Title</label>
            <input type="text">
        </div>
        <div>
            <label>Country *</label>
            <input type="text" required>
        </div>
        <div>
            <label>Participant Type *</label>
            <select required>
                <option value="">Select...</option>
                <option>CMAK Member</option>
                <option>Non-Member Professional</option>
                <option>Government / Public Sector</option>
                <option>Academic / Researcher</option>
                <option>Student</option>
                <option>International Guest</option>
            </select>
        </div>
        <div class="full">
            <label>Special Requests / Comments</label>
            <textarea placeholder="Dietary requirements, accessibility needs, questions..."></textarea>
        </div>
        <div class="full">
            <button type="submit" class="eng-form-submit">Submit Registration</button>
        </div>
    </form>
</div>
@endsection
