@extends('layouts.admin')

@section('content')
    <div class="py-4 admin-page-info">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item " style="margin-top: -1px">
                            <a href="{{ route('home') }}">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Articles</li>
                    </ol>
                </nav>
                <h2 class="h4"> <i class="fa-solid fa-file-lines text-primary"></i> Articles List</h2>
                <p class="mb-0">You can manage this table  and do all opration system create , show, edit and delete</p>
            </div>
            <!--------------- If No SubCategory hide create btn --------------->
            @can('Add Articles')
            @if (isset($categoriesCount) && $categoriesCount > 0)
                <div class="btn-toolbar mb-2 mb-md-0"><a href="{{ route('admin.articles.create') }}"
                        class="btn btn-sm btn-primary d-inline-flex align-items-center"> <i class="fa-solid fa-plus"></i> &nbsp; New Article</a>
                </div>
            @endif
            @endcan
        </div>

        <div class="table-settings mb-4">
            <div class="row justify-content-between align-items-center">

                <!--------------- Search Form --------------->
                <div class="col-9 col-lg-8 d-md-flex">
                    <form action="{{ route('admin.articles.search') }}" method="POST" class="input-group me-2 me-lg-3 fmxw-400">
                        <button type="submit" class="input-group-text">
                            <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        @csrf
                        <input type="text" name="search" class="form-control @error('search') is-invalid @enderror"
                        placeholder="Search articles by title"  value='{{ Request::input('search') }}' autocomplete="off" maxlength="55" required/>
                        @error('search')
                            <div class="invalid-feedback" style="margin-left: 40px">{{ $message }}.</div>
                        @enderror
                    </form>
                </div>

                <div class="col-3 col-lg-4 d-flex justify-content-end align-items-center gap-2">

                    @if(Route::is('admin.articles.index'))
                        @can('Show Articles Trash')
                            <!------------------ Trash ------------------->
                            <div title="Trash" role="button">
                                <a href="{{ route('admin.articles.trash') }}">
                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                </a>
                            </div>
                        @endcan
                    @endif

                    <!------------------ Dynamic Pagination ------------------->
                    @if( preg_match('(search)', url()->current()) !== 1 )  <!---- Remove in search Page ---->
                        <div class="btn-group">
                            <div class="dropdown me-1">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg
                                        class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                                        </path>
                                    </svg> <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dynamic-pagination dropdown-menu dropdown-menu-end pb-0">
                                    <span class="small ps-3 fw-bold text-dark">Show</span>

                                    <a class="dropdown-item {{ Request::is('*/perPage/10') ? 'active' : '' }} {{ Request::is('admin/article') ? 'active' : '' }}"
                                       href="{{ route('admin.articles.perPage', 10) }}"> 10 </a>
                                    <a class="dropdown-item {{ Request::is('*/perPage/30') ? 'active' : '' }}"
                                       href="{{ route('admin.articles.perPage', 30) }}"> 30 </a>
                                    <a class="dropdown-item {{ Request::is('*/perPage/50') ? 'active' : '' }}"
                                       href="{{ route('admin.articles.perPage', 50) }}"> 50 </a>
                                    <a class="dropdown-item {{ Request::is('*/perPage/100') ? 'active' : '' }}"
                                       href="{{ route('admin.articles.perPage', 100) }}"> 100 </a>

                                </div>

                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>




        <!--------------- Session Alert ----------------->
        @if (session()->has('success'))
            <div class="notyf" style="justify-content: flex-end; align-items: end;">
                <div class="notyf__toast notyf__toast--upper notyf__toast--disappear" style="animation-delay: 3s;">
                    <div class="notyf__wrapper">
                        <div> <i class="fa-solid fa-check pr-2"></i> {{ session()->get('success') }} </div>
                    </div>
                    <div class="notyf__ripple" style="background: #0ea271;"></div>
                </div>
            </div>
        @elseif(session()->has('failed'))
            <div class="notyf" style="justify-content: flex-end; align-items: end;">
                <div class="notyf__toast notyf__toast--upper notyf__toast--disappear" style="animation-delay: 3s;">
                    <div class="notyf__wrapper">
                        <div> <i class="fa-solid fa-x pr-2"></i> {{ session()->get('failed') }} </div>
                    </div>
                    <div class="notyf__ripple" style="background: #ca1a41;"></div>
                </div>
            </div>
        @endif



        @if ($articles->isEmpty())
            <!----------- No Data ------------->
            <div class="card card-body shadow border-0 d-flex justify-content-center align-items-center">
                <img src="{{ asset("volt_template_assets/images/no_data.png") }}" alt="no_data" class="img-fluid" style="max-width: 500px">
                <h5>Sorry... No Data Available !!</h5>
            </div>
        @else
            <!----------- Index Table ------------->
            <div class="card card-body shadow border-0 table-wrapper table-responsive">

                <!----------- multi Action ------------->
                <form id="multi-action-form" action="{{ route("admin.articles.multiAction") }}" method="POST">
                    @csrf

                    @canany(['Delete Articles', 'ForceDelete Articles', 'Restore Articles'])
                    <div class="pb-3">
                        <select id="select-action" class="form-select fmxw-200" name="action" aria-label="Message select example" style="display:inline">
                            <option value="" selected="selected" style="display: none"> Choose Action </option>
                            @can('Delete Articles')
                                <option value="delete"> Delete Article</option>
                            @endcan
                            @can('ForceDelete Articles')
                                <option value="forceDelete"> Destroy Article</option>
                            @endcan
                            @if( Route::is('admin.articles.trash') )
                                @can('Restore Articles')
                                    <option value="restore"> Restore Article</option>
                                @endcan
                            @endif
                        </select>
                        <button type="submit" id="multi-alert-btn" class="btn btn-sm px-3 btn-primary ms-3 multi-alert" disabled> <i class="fa-solid fa-list-check"></i> Apply</button>

                        @error('action')
                            <div class="invalid-feedback" style="margin-left: 10px;display: block;" >{{ $message }}.</div>
                        @enderror

                    </div>
                    @endcanany
                    <table class="table article-table table-hover align-items-center index-table">
                        <thead>
                            <tr>
                                @canany(['Delete Articles', 'ForceDelete Articles', 'Restore Articles'])
                                <th class="border-bottom">
                                    <div class="form-check dashboard-check">
                                        <input  class="form-check-input checkbox-head" type="checkbox" id="main-checker">
                                        <label class="form-check-label" for="userCheck55"> </label>
                                    </div>
                                </th>
                                @endcanany
                                <th class="border-bottom">Title</th>
                                <th class="border-bottom">Author</th>
                                <th class="border-bottom">Pinned</th>
                                <th class="border-bottom">Date Created</th>
                                <th class="border-bottom">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    @canany(['Delete Articles', 'ForceDelete Articles', 'Restore Articles'])
                                    <td>
                                        <div class="form-check dashboard-check">
                                            <input name="id[]" value="{{ $article->id }}" class="form-check-input checkbox-head check-item"  type="checkbox">
                                            <label class="form-check-label" for="userCheck55">  </label>
                                        </div>
                                    </td>
                                    @endcanany
                                    <td><a href="{{ route('admin.articles.show', $article->slug) }}" class="d-flex align-items-center">
                                            <div class="d-block">
                                                <span class="fw-bold">
                                                    @if ( strlen($article->title) > 30 )
                                                        {{ Str::ucfirst( substr( $article->title , 0, 30 )) }}...
                                                    @else
                                                        {{  Str::ucfirst( $article->title ) }}
                                                    @endif
                                                </span>
                                                <div class="small text-gray">{{ $article->email }}</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{ $article->author->name }}</td>
                                    <td class="check-icons">
                                            @if ( $article->pinned === "0" )
                                                <span class="text-gray"> <i class="fa-solid fa-minus fa-2x"></i> </span>
                                            @else
                                                <span class="text-success"> <i class="fa-regular fa-circle-check fa-2x"></i> </span>
                                            @endif
                                        </td>
                                    <td><span class="fw-normal">{{ $article->created_at }}</span></td>
                                    <td class="actions">
                                        <a href="{{ route('admin.articles.show', $article->slug) }}" class="text-tertiary"> <i
                                                class="fa-solid fa-eye fa-lg"></i>
                                        </a>
                                        @if( Route::is('admin.articles.index') )
                                            @can('Edit Articles')
                                            <a href="{{ route('admin.articles.edit', $article->slug) }}" class="text-info"> <i
                                                    class="fa-solid fa-pen-to-square fa-lg"></i>
                                            </a>
                                            @endcan
                                            @can('Delete Articles')
                                            <a href="{{ route('admin.articles.delete', $article->id) }}" class="text-info delete-record">
                                                <i class="fa-solid fa-trash-can text-danger fa-lg"></i>
                                            </a>
                                            @endcan
                                        @else
                                            @can('Restore Articles')
                                                <a href="{{ route('admin.articles.restore', $article->id) }}" class="text-info">
                                                    <i class="fa-solid fa-retweet fa-lg"></i>
                                                </a>
                                            @endcan
                                            @can('ForceDelete Articles')
                                                <a href="{{ route('admin.articles.force.delete', $article->id) }}" class="text-info delete-record">
                                                    <i class="fa-solid fa-xmark text-danger fa-lg"></i>
                                                </a>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div
                        class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center">
                            {{ $articles->links('pagination::bootstrap-4') }}
                        </div>
                        <div class="fw-normal small mt-4 mt-lg-0">
                            Showing <b>{{ $articles->firstItem() }}</b> to <b>{{ $articles->lastItem() }}</b>
                            of total <b>{{ $articles->total() }}</b> entries
                        </div>
                    </div>
                </form>
            </div>



        @endif



    </div>
@endsection
