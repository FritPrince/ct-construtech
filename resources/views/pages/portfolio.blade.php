@extends('layouts.app')

@section('title', 'Portfolio - CT ConstructTech')

@section('content')

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('storage/template/assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Nos Projets</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route('home') }}'>Accueil </a><span class="icon">-</span><a class='inner-page' href='{{ route('portfolio') }}'> Portfolio</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="project-section-inner bg-grey pt-130 pb-130">
            <div class="container container-2">
                <div class="project-item-wrap-2">
                    @foreach($projects as $project)
                    <div class="project-item-2 antra-hover-view">
                        <div class="project-thumb">
                            <a href="{{ route('portfolio.show', $project) }}"><img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"></a>
                            <ul>
                                @foreach($project->categories as $cat)
                                <li>{{ $cat->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="project-content">
                            <h3 class="title"><a href="{{ route('portfolio.show', $project) }}">{{ $project->title }}</a></h3>
                            <p>{{ $project->location }} <br> {{ $project->year }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ./ project-section -->

@endsection
