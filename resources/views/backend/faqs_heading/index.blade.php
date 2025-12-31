@extends('layouts.app')
@section('title', 'Faqs Heading Details')
@section('style')
<style>
   .custom-th {
    width: 250px; /* Set your desired width */
}
</style>
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                    @include('_message')

                        <div class="card-header">
                            <h4>Faqs Breadcrumb Details</h4>
                        </div>
                        <div class="card-body">


                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                        <th class="custom-th">Small Heading</th>
                                        <td>{{ $faqsHeading->small_heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading</th>
                                        <td>{{ $faqsHeading->heading ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="custom-th">Heading Description</th>
                                        <td>{{ $faqsHeading->heading_description ?? '' }}</td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="card-footer text-right">
                            <a href="{{ route('backend.faqs_heading.edit', $faqsHeading?->id) }}" class="btn btn-primary">Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
