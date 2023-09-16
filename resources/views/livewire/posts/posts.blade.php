<main>
    <div class="create_model">
        <div class="modal-header" id="kt_modal_create_api_key_header">
            <!--begin::Modal title-->
            <h2>Create Product</h2>
            <!--end::Modal title-->
        </div>
        <form class="form" wire:submit.prevent="storePostData">
            <div class="py-10 modal-body px-lg-17">
                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <label class="mb-2 required fs-5 fw-bold">Post Title</label>
                    <input class="form-control form-control-solid" type="text" placeholder="Your Post Title"
                        wire:model.debounce.50ms="title" name="title" />
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!--begin::Input group-->
                <div class="mb-5 fv-row">
                    <label class="mb-2 required fs-5 fw-bold">Post Body</label>
                    <textarea class="form-control form-control-solid" placeholder="Your Post Body" wire:model.debounce.50ms="body"
                        name="body"></textarea>
                    @error('body')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--begin::Input group-->
                <div class="mb-5 fv-row flex-center">
                    </span>
                    <button class="btn btn-primary" wire:target="storePostData">Add Post</button>
                </div>
            </div>
        </form>
    </div>

    @if (count($posts) != 0)
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                    <tr>
                        <th class="p-0 w-20px">#</th>
                        <th class="p-0 w-50px">Post Title</th>
                        <th class="p-0 w-50px">Actions</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th style="text-align: center">
                                <div class="mb-1 text-dark fw-bolder text-hover-primary fs-6">
                                    {{ $loop->iteration }}
                                </div>
                            </th>
                            <td style="text-align: center">
                                <div style="text-align: start" class="mb-1 text-dark fw-bolder text-hover-primary fs-6">
                                    {{ $post->title }}
                                </div>
                            </td>
                            <td style="text-align: center">
                                <div style="display: flex;gap: 5px">
                                    <div style="text-align: start" class="mb-1 text-dark fw-bolder fs-6">
                                        <a href="{{ route('products.show', 1) }}" class="btn btn-sm btn-primary"
                                            id="kt_toolbar_primary_button"><i style="padding: 0"
                                                class="bi bi-eye-fill"></i></a>
                                    </div>
                                    <div style="text-align: start" class="mb-1 text-dark fw-bolder fs-6">
                                        <a href="{{ route('products.edit', 2) }}" class="btn btn-sm btn-primary"
                                            id="kt_toolbar_primary_button"><i class="bi bi-pencil-square"
                                                style="padding: 0"></i></a>
                                    </div>
                                    <div style="text-align: start" class="mb-1 text-dark fw-bolder fs-6">
                                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_delete" id="kt_toolbar_primary_button"><i
                                                style="padding: 0" class="bi bi-trash-fill"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->


        </div>
    @else
        There is No Product Yet!
    @endif
    <!--begin::Modal - Create Api Key-->
    <div wire:ignore class="modal fade" id="create" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Create Post</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">

                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Form-->
                <form wire:submit.prevent="storePostData">
                    <!--begin::Modal body-->
                    <div class="py-10 modal-body px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_create_api_key_header"
                            data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="mb-2 required fs-5 fw-bold">Post Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid"
                                    placeholder="Your Post Title" wire:model="title" />
                                <!--end::Input-->
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="mb-2 required fs-5 fw-bold">Post Body</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid" wire:model="body" rows="5" placeholder="Your Post Body"></textarea>
                                <!--end::Input-->
                                @error('body')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" wire:target="storePostData" :disabled="$disabled"
                            class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>

                <!--end::Form-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Api Key-->
    {{-- <div class="modal fade" id="addPostModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog"
         aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="storePostData">
                        <div class="form-group row">
                            <label for="title" class="col-3">Title</label>
                            <div class="col-9">
                                <input type="text" id="title" class="form-control" wire:model="title">
                                @error('title')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-3">Body</label>
                            <div class="col-9">
                                <input type="text" id="body" class="form-control" wire:model="body">
                                @error('body')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Add Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!--begin::Modal - Delete-->
    <div class="modal fade" id="kt_modal_delete" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Are you sure you want to delete post?</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Form-->
                <form id="kt_modal_create_api_key_form" class="form" method="post"
                    action="{{ route('products.destroy', 2) }}">
                    @csrf
                    @method('delete')
                    <!--begin::Modal footer-->

                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <!--begin::Button-->
                        <a href="" class="btn btn-light me-3" data-bs-dismiss="modal">No
                        </a>
                        <button type="submit" id="kt_modal_create_api_key_submit" class="btn btn-danger">
                            <span class="indicator-label">Yes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Delete-->


</main>
@push('scripts_livewire')
    <script>
        window.addEventListener(`close-modal`, event => {
            $('#create').modal('hide');
        });
    </script>
@endpush
