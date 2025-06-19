@extends('admin.layouts.index')
@section('title')
    Qrup detal ({{ $languageGroup->name }})
@endsection

@section('content')


    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Qrup detal</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}" class="text-muted">Panel</a>
                        </li>
                        @isset($searchText)
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.languageGroup.index') }}" class="text-muted">Dil Qrupları</a>
                            </li>
                            <li class="breadcrumb-item">
                                Axtar
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.languageGroup.index') }}" class="text-muted">Dil Qrupları</a>
                            </li>
                            <li class="breadcrumb-item">
                                Detal
                            </li>
                        @endisset
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Qrup detal ({{ $languageGroup->name }}) </h3>


                    </div>
                    <div class="card-toolbar">
                        <div class="card-title">
                            <form action="{{ route('admin.languageGroup.groupDetailSearch',$languageGroup->id) }}" method="GET">
                                <div class="input-group">
                                    <input
                                        type="search"
                                        class="form-control"
                                        value="@isset($searchText){{ $searchText }}@endisset"
                                        autocomplete="off"
                                        name="search"
                                        placeholder="Axtar...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success" type="button">Axtar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--  ADD BUTTON  -->
                        <button
                            tooltip="Əlavə et"
                            flow="left"
                            data-toggle="modal"
                            data-target="#addDataModalButton"
                            class="btn addDataModalButton btn-icon btn-success btn-circle btn-lg">
                            <i class="flaticon-plus"></i>
                        </button>


                        <!--  DELETE BUTTON  -->
                        <a class="select-btn-action" href="#">
                            <button
                                tooltip="Sil"
                                flow="left"
                                class="btn btn-icon btn-danger btn-circle btn-lg ml-2">
                                <i class="flaticon-delete"></i>
                            </button>
                        </a>


                        <!--Elave et Modal START-->
                        <div class="modal fade" id="addDataModalButton"  role="dialog"
                             aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Yeni ifadə əlavə et</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body ">

                                        <!--  Errors  -->
                                        <div class="errorsText">
                                            <div class="alert alert-custom alert-light-danger fade show mb-5"
                                                 role="alert">
                                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                <div class="alert-text">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!--begin::Form-->
                                        <form id="languagePhraseAddForm" action="" method="POST">
                                        @csrf

                                        <!--  Key  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Key</label>
                                                <div class="col-md-6">
                                                    <input class="form-control formAddKey" name="key"
                                                           type="text">
                                                </div>
                                                <input type="hidden" name="groupID" value="{{ $languageGroup->id }}">
                                            </div>



                                            <!--  Foto  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Foto</label>
                                                <div class="col-md-6">
                                                  <span class="switch switch-outline switch-icon switch-success ">
                                                    <label>
                                                     <input class="imagesActive" type="checkbox"
                                                            name="imagesActive"/>
                                                     <span></span>
                                                    </label>
                                                   </span>
                                                </div>
                                            </div>

                                            <!--  Editor  -->
                                            <div class="form-group row mt-7 editorActiveContainer">
                                                <label class="col-form-label text-right col-md-3">Editor</label>
                                                <div class="col-md-6">
                                                  <span class="switch switch-outline switch-icon switch-success ">
                                                    <label>
                                                     <input class="editorActive" type="checkbox"
                                                            name="editorActive"/>
                                                     <span></span>
                                                    </label>
                                                   </span>
                                                </div>
                                            </div>

                                            <!--  Tercume  -->
                                            <div class="form-group row mt-10 ">
                                                <div class="col-md-12">
                                                    <ul class="nav nav-tabs mt-5" role="tablist">
                                                        @foreach($languages as $language)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif "
                                                                   id="{{$language->code}}" data-toggle="tab"
                                                                   href="#tab-{{$language->code}}">
																	<span class="mr-1">
																		<img class="h-15px w-15px rounded-sm"
                                                                             src="{{ countryFlag($language->code) }}"
                                                                             alt="{{ $language->code }}">
																	</span>
                                                                    <span
                                                                        class="nav-text">{{ $language->short_name }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content mt-5">
                                                        @foreach($languages as $key => $language)
                                                            <div
                                                                class="tab-pane fade @if($loop->first) active @endif show"
                                                                id="tab-{{$language->code}}" role="tabpanel"
                                                                aria-labelledby="{{$language->code}}">

                                                                <!--  IMAGES START  -->
                                                                <div class="language-images-container">
                                                                    <div
                                                                        class="images-post-container">
                                                                        <div class="images-post-item" >

                                                                            <div
                                                                                style="display: none"
                                                                                data-languageID="{{ $language->id }}"
                                                                                tooltip="Sil"
                                                                                class="notPhotoPost notPhotoPost_{{ $language->id }}">
                                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                            </div>
                                                                            <figure
                                                                                data-languageID="{{ $language->id }}"
                                                                                class="activeButton activeButtonAdd"
                                                                            >

                                                                                <img
                                                                                    src="{{old('image.'. $language->id) == null ? asset('storage/no-image.png'): old('image.'. $language->id) }}"
                                                                                    class="previewImage_{{ $language->id }}"
                                                                                >

                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                    <!--  IMAGE INPUT  -->
                                                                    <div class="image-post-input">
                                                                    <input type="text"
                                                                           id="image_label_{{ $language->id }}"
                                                                           name="image[{{ $language->id }}]"
                                                                           value="{{ old('image.'. $language->id ) }}"
                                                                    >

                                                                </div>
                                                                </div>
                                                                <!--  IMAGES END  -->

                                                                <!--  TEXTAREA START  -->
                                                                <div class="language-textarea-container">
                                                                    <div class="default-editor">
                                                                                  <textarea rows="6"
                                                                                            name="translate[{{$language->id}}]"
                                                                                            class="form-control translate"></textarea>
                                                                    </div>

                                                                    <div class="tiny-editor">
                                                                                  <textarea
                                                                                      id="editorTiny-{{$language->id}}"
                                                                                      data-index="editorTiny-{{$language->id}}"
                                                                                      rows="6"
                                                                                      name="translateEditor[{{$language->id}}]"
                                                                                      class="form-control editorTiny translateEditor"></textarea>
                                                                    </div>
                                                                </div>
                                                                <!--  TEXTAREA END  -->


                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </form>


                                        <!--end::Form-->


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger font-weight-bold"
                                                data-dismiss="modal">Bağla
                                        </button>
                                        <button type="button"
                                                class="btn languagePhraseAdd btn-success font-weight-bold">Yadda
                                            saxla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Elave et Modal END-->


                        <!--Redakte et Modal START-->
                        <div class="modal fade" id="editDataModalButton"  role="dialog"
                             aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title editMOdalTitle"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body ">


                                        <!--  Errors  -->
                                        <div class="errorsText2">
                                            <div class="alert alert-custom alert-light-danger fade show mb-5"
                                                 role="alert">
                                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                <div class="alert-text">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>


                                        <!--begin::Form-->
                                        <form id="languageGroupUpdateForm" action="" method="POST">
                                        @csrf

                                            <!--  Key  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Key</label>
                                                <div class="col-md-6">
                                                    <input class="form-control formAddKey" name="key"
                                                           type="text" {{ env('APP_DEBUG') == false ? 'readonly' : '' }}>
                                                </div>
                                                <input type="hidden" name="phraseID" class="phraseID">
                                            </div>



                                            <!--  Qrup  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Qrup</label>
                                                <div class="col-md-6">
                                                    <div class="LanguageList">
                                                        <select name="groupID" class="form-control countriesOverflow selectpicker"
                                                                data-size="5" data-live-search="true">
                                                            <option value="">Select</option>
                                                            @foreach($languageGroups as  $item)
                                                                <option
                                                                    @if($languageGroup->id == $item->id)
                                                                    selected="selected"
                                                                    @endif
                                                                    value="{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <!--  Foto  -->
                                            <div class="form-group row mt-10 ">
                                                <label class="col-form-label text-right col-md-3">Foto</label>
                                                <div class="col-md-6">
                                                  <span class="switch switch-outline switch-icon switch-success ">
                                                    <label>
                                                     <input class="imagesActiveEdit" type="checkbox"
                                                            name="imagesActive"/>
                                                     <span></span>
                                                    </label>
                                                   </span>
                                                </div>
                                            </div>


                                            <!--  Editor  -->
                                            <div class="form-group row mt-10 editorActiveContainer">
                                                <label class="col-form-label text-right col-md-3">Editor</label>
                                                <div class="col-md-6">
                                                  <span class="switch switch-outline switch-icon switch-success ">
                                                    <label>
                                                     <input id="editorActive" class="editorActive" type="checkbox"
                                                            name="editorActive"/>
                                                     <span></span>
                                                    </label>
                                                   </span>
                                                </div>
                                            </div>

                                            <!--  Tercume  -->
                                            <div class="form-group row mt-10 ">
                                                <div class="col-md-12">
                                                    <ul class="nav nav-tabs mt-5" role="tablist">
                                                        @foreach($languages as $language)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif "
                                                                   id="{{$language->code}}" data-toggle="tab"
                                                                   href="#tabEdit-{{$language->code}}">
																	<span class="mr-1">
																		<img class="h-15px w-15px rounded-sm"
                                                                             src="{{ countryFlag($language->code) }}"
                                                                             alt="{{ $language->code }}">
																	</span>
                                                                    <span
                                                                        class="nav-text">{{ $language->short_name }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content mt-5">
                                                        @foreach($languages as $language)
                                                            <div
                                                                class="tab-pane fade @if($loop->first) active @endif show"
                                                                id="tabEdit-{{$language->code}}" role="tabpanel"
                                                                aria-labelledby="{{$language->code}}">


                                                                <!--  IMAGES START  -->
                                                                <div class="language-images-container language-images-container-edit">
                                                                    <div
                                                                        class="images-post-container">
                                                                        <div class="images-post-item" >

                                                                            <div
                                                                                style="display: flex"
                                                                                data-languageID="{{ $language->id }}"
                                                                                tooltip="Sil"
                                                                                class="notPhotoPost notPhotoPost_{{ $language->id }}">
                                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                            </div>
                                                                            <figure
                                                                                data-languageID="{{ $language->id }}"
                                                                                class="activeButton activeButtonEdit"
                                                                            >

                                                                                <img
                                                                                    src="{{ asset('storage/no-image.png')  }}"
                                                                                    class="previewImage_{{ $language->id }} previewImageEdit_{{ $language->id }}"
                                                                                >

                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                    <!--  IMAGE INPUT  -->
                                                                    <div class="image-post-input">
                                                                        <input type="text"
                                                                               id="image_label_edit_{{ $language->id }}"
                                                                               name="image[{{ $language->id }}]"
                                                                        >

                                                                    </div>
                                                                </div>
                                                                <!--  IMAGES END  -->

                                                                <!--  TEXTAREA START  -->
                                                                <div class="language-textarea-container language-textarea-container-edit">
                                                                    <div class="default-editor">
                                                                                  <textarea rows="6"
                                                                                            id="translateEdit-{{$language->id}}"
                                                                                            data-index="{{$language->id}}"
                                                                                            name="translate[{{$language->id}}]"
                                                                                            class="form-control translateEdit"></textarea>
                                                                    </div>

                                                                    <div class="tiny-editor">
                                                                                  <textarea rows="6"
                                                                                            id="editorTinyEdit-{{$language->id}}"
                                                                                            data-index="{{$language->id}}"
                                                                                            name="translateEditor[{{$language->id}}]"
                                                                                            class="form-control editorTiny translateEditEditor"></textarea>
                                                                    </div>
                                                                </div>
                                                                <!--  TEXTAREA END  -->

                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </form>


                                        <!--end::Form-->


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger font-weight-bold"
                                                data-dismiss="modal">Bağla
                                        </button>
                                        <button type="button"
                                                class="btn languagePhraseUpdate  btn-success font-weight-bold">
                                            Yadda
                                            saxla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Redakte et Modal END-->

                    </div>
                </div>

                <div class="card-body">
                    <!--  MYTABLE START  -->
                    <table class="table table-hover table-striped" data-sorting="true">
                        <thead class="thead-light">
                        <tr>
                            @if($languagePhrases->count() != 0)
                                <th width="10" data-sortable="false">
                                    <label class="checkbox checkbox-success select-all-btn">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </th>
                            @endif
                            <th width="10" data-breakpoints="xs">ID</th>
                            <th>Key</th>
                            @foreach($languages as $language)
                                <th data-breakpoints="xs sm md">{{ $language->name }}</th>
                            @endforeach
                            <th width="40" data-breakpoints="xs sm md" data-sortable="false">Ayarlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($languagePhrases as $languagePhrase)
                            <tr class="table-id-{{ $languagePhrase->id }}">

                                <!-- SELECT ALL -->
                                <td>
                                    <label class="checkbox checkbox-success select-element-btn" data-id="{{ $languagePhrase->id }}">
                                        <input type="checkbox"   />
                                        <span></span>
                                    </label>
                                </td>


                                <td>{{ $languagePhrase->id }}</td>
                                <td
                                    class="copyClipboard"
                                    id="kt_clipboard_{{ $languagePhrase->id }}"
                                    data-clipboard="true"
                                    data-clipboard-target="#kt_clipboard_{{ $languagePhrase->id }}"
                                >
                                    {{ $languagePhrase->key }}
                                </td>


                                @if($languagePhrase->editor == 2)
                                    @foreach($languagePhrase->translate as $translate)
                                        <td>
                                            @if(empty($translate->value))
                                                <div class="language-image-decoration">
                                                    <img  src="{{ asset('storage/no-image.png') }}" alt="No Image">
                                                </div>
                                            @else
                                                <div class="language-image-decoration">
                                                    <img  src="{{ $translate->value }}" alt="Image">
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach

                                @else
                                    @foreach($languagePhrase->translate as $translate)
                                        <td>
                                            @if(empty($translate->value))
                                                <span class="text-danger">Boshdur</span>
                                            @else
                                                {!!   strip_tags(Str::limit($translate->value,50,'...'))  !!}
                                            @endif
                                        </td>
                                    @endforeach
                                @endif


                                <td>
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title=""
                                         data-placement="left" data-original-title="Quick actions">
                                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right"
                                             style="">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header font-weight-bold py-4">
                                                    <span class="font-size-lg">Ayarlar:</span>
                                                    <i class="flaticon2-information icon-md text-muted"
                                                       data-toggle="tooltip" data-placement="right" title=""
                                                       data-original-title="Click to learn more..."></i>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>

                                                <li
                                                    data-id="{{ $languagePhrase->id }}"
                                                    data-toggle="modal"
                                                    data-target="#editDataModalButton"
                                                    class="navi-item redakteEt">
                                                    <a href="#" class="navi-link text-center">
																		<span class="navi-text">
																			<span
                                                                                class="label label-xl label-inline label-light-primary">Redaktə et</span>
																		</span>
                                                    </a>
                                                </li>

                                                <li
                                                    class="navi-item deleteButton"
                                                    data-id="{{ $languagePhrase->id }}"
                                                >
                                                    <a href="#" class="navi-link text-center">
																		<span class="navi-text">
																			<span
                                                                                class="label  label-xl label-inline label-light-danger">Sil</span>
																		</span>
                                                    </a>
                                                </li>

                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--  MYTABLE END  -->
                </div>
                <div class="card-footer">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex align-items-center py-3">
                            <span class="text-muted">
                                Cəmi <b><span class="totalCount">{{ $languagePhrases->total() }}</span></b> yazı
                                @if($languagePhrases->hasPages())
                                    , <b>{{ $languagePhrases->lastPage() }}
                                </b> səhifədən  <b>{{ $languagePhrases->currentPage() }}</b>-ci göstərildi.
                                @endif

                            </span>
                        </div>
                        <!--  Paginate START -->
                        <div class="d-flex flex-wrap py-2 mr-3">
                            {{ $languagePhrases->appends(['search' => isset($searchText) ? $searchText : null])
                                 ->render('vendor.pagination.backend.my-pagination') }}
                        </div>
                        <!--  Paginate END -->
                    </div>

                </div>
            </div>


        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

@section('CSS')
    <style>
        input:read-only {
            background-color: #ebebeb !important;
        }

        .images-post-item .activeButton img{
            width: 170px;
            height: 170px;
            object-fit: cover;
        }

        .images-post-container {
            display: flex;
            justify-content: start;
            align-items: start;
        }


        .language-images-container {
            display: none;
        }

        .language-image-decoration{

        }

        .language-image-decoration img{
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 3px;
        }

    </style>
@endsection

@section('js')


    <script>
        jQuery(function ($) {
            $('.table').footable({
                "empty": "Məlumat tapılmadı",
            });
        });
    </script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });


        /*   Add START   */

        $(document).on('click', '.addDataModalButton', function () {
            $('.errorsText').hide();
            $('.formAddKey').val('');
            $('.translate').val('');

            $('.imagesActive').prop( "checked", false );
            $('.editorActive').prop( "checked", false );
            $('.editorActiveContainer').show();
            $('.language-images-container').hide();
            $('.language-textarea-container').show();
            $('.tiny-editor').hide();
            $('.default-editor').show();
            $('.notPhotoPost').hide();

            $('.activeButton img').attr('src','{{ asset('storage/no-image.png') }}');

            $('.editorTiny').each(function (index, value) {
                var id = $(this).data('index');
                tinymce.get(id).setContent("");

            })

        })

        $(document).on('click', '.languagePhraseAdd', function () {

            //Ajax sorgu zamani olan problemi aradan qaldirir (deyerler gonderilmediyi ucun)
            tinyMCE.triggerSave();

            var languageGroupFormData = $("#languagePhraseAddForm").serialize();
            $('.errorsText ul').text('');


            $.ajax({
                url: "{{ route('admin.languageGroup.phraseAdd') }}",
                type: 'POST',
                data: languageGroupFormData,
                dataType: 'JSON',
                success: function (response) {
                    var errors = response.msg;

                    <!--  Butun errorlari yaz  -->
                    $.each(errors, function (index, error) {
                        $('.errorsText ul').append('<li>' + error + '</li>')
                        $('.errorsText').fadeIn();
                    })


                    if (response.success) {
                        $('.errorsText').remove();
                        toastr.success("Key və tərcümə əlavə olundu");
                        setTimeout(function () {
                            window.location.href = "{{ route('admin.languageGroup.detail',$languageGroup->id) }}";
                        }, 1000);

                    }

                }
            });

        })
        /*   Add END   */

        /*   Edit START   */
        $(document).on('click', '.redakteEt', function () {

            $('.errorsText2').hide();

            var languagePhraseID = $(this).data('id');


            $.ajax({
                url: "{{ route('admin.languageGroup.phraseEditAjax') }}",
                type: 'POST',
                data: {languagePhraseID: languagePhraseID},
                dataType: 'JSON',
                success: function (response) {
                    var key = response.success.phraseKey;
                    var phraseID = response.success.phraseID;
                    $('.formAddKey').val(key);
                    $('.phraseID').val(phraseID);


                    $('.translateEdit').each(function (index, value) {
                        var id = $(this).data('index');
                        $('#translateEdit-'+id).val(response.success.translate[id]);

                        var emptytext = '';
                        if(!response.success.translate[id]){
                            emptytext = '';
                        }else{
                            emptytext = response.success.translate[id];
                        }
                         tinymce.get('editorTinyEdit-'+id).setContent(emptytext);

                        $('.notPhotoPost_'+id).hide();
                    })



                    if(response.success.editor == 1){
                       $('.editorActive').prop( "checked", true );
                        $('.imagesActiveEdit').prop( "checked", false );
                        $('.default-editor').hide();
                        $('.tiny-editor').show();

                        $('.language-images-container').hide();
                        $('.language-textarea-container').show();
                        $('.editorActiveContainer').show();


                    } else if(response.success.editor == 2){
                        $('.imagesActiveEdit').prop( "checked", true );
                        $('.language-images-container').show();
                        $('.language-textarea-container').hide();
                        $('.editorActiveContainer').hide();
                        $('textarea').val('');

                        $('.translateEdit').each(function (index, value) {
                            var id = $(this).data('index');
                            tinymce.get('editorTinyEdit-'+id).setContent('');

                            if(response.success.translate[id] == ''){
                                $('.language-images-container-edit .previewImage_'+id).attr('src','{{ asset('storage/no-image.png') }}');
                                $('#image_label_edit_'+id).attr('value','');
                                $('.notPhotoPost_'+id).hide();
                            }else {
                                $('.language-images-container-edit .previewImage_'+id).attr('src',response.success.translate[id]);
                                $('#image_label_edit_'+id).attr('value',response.success.translate[id]);
                                $('.notPhotoPost_'+id).show();
                            }

                        })

                    } else{
                        $('.editorActive').prop( "checked", false );
                        $('.imagesActiveEdit').prop( "checked", false );
                        $('.tiny-editor').hide();
                        $('.default-editor').show();


                        $('.language-images-container').hide();
                        $('.language-textarea-container').show();
                        $('.editorActiveContainer').show();

                    }


                }
            });


        })
        /*   Edit END   */


        /*   Update START   */
        $(document).on('click', '.languagePhraseUpdate', function () {
            //Ajax sorgu zamani olan problemi aradan qaldirir (deyerler gonderilmediyi ucun)
            tinyMCE.triggerSave();

            var languageGroupFormData = $("#languageGroupUpdateForm").serialize();
            $('.errorsText2 ul').text('');


            $.ajax({
                url: "{{ route('admin.languageGroup.phraseUpdate') }}",
                type: 'POST',
                data: languageGroupFormData,
                dataType: 'JSON',
                success: function (response) {

                    var errors = response.msg;


                    $.each(errors, function (index, error) {
                        $('.errorsText2 ul').append('<li>' + error + '</li>')
                        $('.errorsText2').fadeIn();
                    })


                    if (response.success) {
                        $('.errorsText2').remove();
                        toastr.success("Key və tərcümə redaktə olundu");
                        setTimeout(function () {
                            {{--window.location.href = "{{ route('admin.languageGroup.detail',$languageGroup->id) }}";--}}
                            window.location.reload();
                        }, 1000);

                    }


                }
            });

        })
        /*   Update END   */


        /*   Delete START   */

        $(document).on('click', '.deleteButton', function () {


            var languagePhraseID = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.languageGroup.groupDetailDeleteAjax') }}",
                type: 'POST',
                data: {id: languagePhraseID},
                dataType: 'JSON',
                success: function (response) {

                    if (response.success) {

                        Swal.fire({
                            title: "Diqqət?",
                            html: "<b>" + response.languagePhraseKey + "</b> keyini silmək istədiyinizə əminsiniz?",
                            icon: "error",
                            showCancelButton: true,
                            confirmButtonText: "Sil!",
                            customClass: {
                                confirmButton: "btn btn-light-danger font-weight-bold",
                                cancelButton: 'btn btn-light-primary font-weight-bold',
                            }
                        }).then(function (result) {

                            if (result.value) {

                                $.ajax({
                                    url: "{{ route('admin.languageGroup.groupDetailDelete') }}",
                                    type: 'POST',
                                    data: {id: languagePhraseID},
                                    dataType: 'JSON',
                                    success: function (response) {

                                        if (response.success) {

                                            $('.table-id-' + languagePhraseID).fadeOut(1000);
                                            var totalCount = $('.totalCount').text();
                                            $('.totalCount').text(parseInt(totalCount) - 1);

                                        }
                                    }
                                });

                                Swal.fire(
                                    "Silindi!",
                                    "<b>" + response.languagePhraseKey + "</b> keyi silindi!",
                                    "success"
                                )
                            }

                        });

                    }


                }
            });


        })

        /*   Delete END   */


        /*   EDITOR ACTIVE START   */
        $(function () {
            $(document).on('click', '.editorActive', function () {

                if ($(this).is(':checked')) {
                    $('.default-editor').hide();
                    $('.tiny-editor').show();
                } else {
                    $('.tiny-editor').hide();
                    $('.default-editor').show();
                }
            })
        })
        /*   EDITOR ACTIVE END   */


        /*   IMAGES ACTIVE START   */
        $(function () {
            $(document).on('click', '.imagesActive', function () {

                if ($(this).is(':checked')) {
                 $('.language-textarea-container').hide();
                 $('.editorActiveContainer').hide();
                    $('.language-images-container').show();
                } else {
                    $('.language-images-container').hide();
                    $('.language-textarea-container').show();
                    $('.editorActiveContainer').show();

                }
            })
        })
        /*   IMAGES ACTIVE END   */


        /*   IMAGES ACTIVE EDIT START   */
        $(function () {
            $(document).on('click', '.imagesActiveEdit', function () {

                if ($(this).is(':checked')) {
                 $('.language-textarea-container').hide();
                 $('.editorActiveContainer').hide();
                    $('.language-images-container').show();
                } else {
                    $('.language-images-container').hide();
                    $('.language-textarea-container').show();
                    $('.editorActiveContainer').show();

                }
            })
        })
        /*   IMAGES ACTIVE EDIT END   */

    </script>


    <!--  TINYMCE START -->
    <script>
        tinymce.init({
            selector: '.editorTiny',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 300,
            forced_root_block: "", // Bunu yandirdiqda adi vaxti <p> tagi ichine alirdisa artiq almiyacaq
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
            entity_encoding: "raw",
            entities: "nbsp",
            relative_urls: false,
            remove_script_host: true,
            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight
                let fileType = meta.filetype;

                /*   BUTTON FUNCTION START   */
                ckfinderTinyMCEButton(x, y, fileType);

            }
        });


    </script>
    <!--  TINYMCE END -->


    <!--  DELETE ALL ELEMENTS (SELECTED) START  -->
    <script>
        deleteALlSelectedElements(
            'Diqqət?',
            'Seçilmişləri silmək istədiyinizə əminsiniz?',
            'Sil!',
            'Xeyir',
            '{{ route('admin.languagePhrase.allDeleteAjax') }}',
            '{{ route('admin.languagePhrase.index') }}'
        );
    </script>
    <!--  DELETE ALL ELEMENTS (SELECTED) END  -->


    <!--  BUTTON IMAGE START  -->
    <script>

        $(document).on('click', '.activeButtonAdd', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderButton(x, y, 'Images');


        })


        $(document).on('click', '.activeButtonEdit', function () {
            $(this).addClass('activeButtonCheck');

            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
            let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight


            /*   BUTTON FUNCTION START   */
            ckfinderButtonLanguageEdit(x, y, 'Images');


        })


        $(function (){
           $('.images-post-item').removeAttr('style');
           $('.images-post-item .activeButton').removeAttr('style');
           $('.images-post-item .activeButton img').removeAttr('style');
        });

        $(window).resize(function (){
            $('.images-post-item').removeAttr('style');
            $('.images-post-item .activeButton').removeAttr('style');
            $('.images-post-item .activeButton img').removeAttr('style');
        })


    </script>
    <!--  BUTTON IMAGE END  -->

@endsection
