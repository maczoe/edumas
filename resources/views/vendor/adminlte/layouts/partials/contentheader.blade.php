<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', '')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
    	<li>
        	<a href="{{ url('/') }}">
        		<i class="fa fa-dashboard"></i> 
        	{{ trans('adminlte_lang::message.level') }}
            </a>
        </li>
        @if(isset($links))
    	@foreach($links as $link)
    		@if($link->active)
        		<li class="active">{{ $link->title }}</li>
        	@else
        		<a href="{{ url($link->route) }}">
        			<li>{{ trans($link->title) }}</li>
        		</a>
        	@endif
        @endforeach
        @endif
    </ol>
</section>