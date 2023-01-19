@extends('layouts.template')
@section('content')
<div class="hero common-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1> Add Publisher</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="search-form">
                        @if(!$errors->isEmpty())
                            <div class="row">
                                <div class="col-md-6 alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        @endif
                        <h4 class="sb-title">Add a Publisher</h4>
                        <form method="post" class="form-style-1" action="{{ route('publisher.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-it">
                                    <label>Publisher name</label>
                                     <input name="publisher_name" type="text" placeholder="Enter publisher name"required>
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Publisher logo</label>
                                    <input name="photo" type="file">
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Official Website</label>
                                    <input name="website_link" type="text" placeholder="Enter official website link">
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Official Twitter</label>
                                    <input name="twitter_link" type="text" placeholder="Enter official twitter link">
                                </div>
                                <div class="col-md-12 form-it">
                                    <label>Description</label>
                                    <textarea name="description"></textarea>
                                </div>
                                <div class="col-md-12 ">
                                    <input class="submit" type="submit" value="submit">
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection