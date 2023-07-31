<main>
    @if(count($colors)!=0)
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle gs-0 gy-5">
                <!--begin::Table head-->
                <thead>
                <tr>
                    <th class="p-0 w-20px">#</th>
                    <th class="p-0 w-50px">Color Name</th>
                    <th class="p-0 w-50px">Color</th>
                    <th class="p-0 w-50px">Color HEX</th>
                    <th class="p-0 w-50px">Actions</th>
                </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                @foreach($colors as $color)
                    <tr>
                        <th style="text-align: center">
                            <div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$loop->iteration}}
                            </div>
                        </th>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$color->name}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                <div class="color-box" style="background-color: {{$color->hex}}"></div>
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="text-align: start"
                                 class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                {{$color->hex}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="display: flex;gap: 5px">
                                <div style="text-align: start" class="text-dark fw-bolder mb-1 fs-6">
                                    <button
                                        wire:click="edit({{ $color->id }})"
                                        class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit_color"
                                        role="button"><i class="bi bi-pencil-square"
                                                         style="padding: 0"></i></button>
                                </div>
                                <div style="text-align: start" class="text-dark fw-bolder  mb-1 fs-6">
                                    <button
                                        wire:click="delete({{ $color->id }})"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete_color"
                                        role="button"><i
                                            style="padding: 0" class="bi bi-trash-fill"></i></button>
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
        <div>There is No Colors Yet!</div>
    @endif

    <div wire:ignore.self class="modal fade" id="create_color" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Create Color</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">

                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)"
                                          fill="black"/>
                                </svg>
                            </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Form-->
                <form wire:submit.prevent="store" id="kt_modal_edit_card" class="form">
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_create_api_key_header"
                             data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Color Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" wire:model="name" class="form-control form-control-solid"
                                       placeholder="Your Color Name" name="name"/>
                                @error('name')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label for="exampleColorInput" class="form-label">Enter Color:</label><br><br>
                                <div class="container">
                                    <input type="color" wire:model="hex" id="style1" value="{{$hex}}"/>
                                    <label for="style1">{{strtoupper($hex)}}</label>
                                </div>
                                <!--end::Input-->
                                @error('hex')
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
                        <button type="submit" wire:target="store" :disabled="$disabled" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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


    <!--begin::Modal - Edit product-->
    <div
        wire:ignore.self
        class="modal fade"
        id="edit_color" tabindex="-1"
        aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>Edit Color | <span style="color: {{$hex}}">{{$edit_color_name}}</span></h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div
                        class="btn btn-sm btn-icon btn-active-color-primary"
                        data-bs-dismiss="modal" id="cl">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                             <svg xmlns="http://www.w3.org/2000/svg"
                                  width="24" height="24"
                                  viewBox="0 0 24 24" fill="none">
                                 <rect opacity="0.5" x="6"
                                       y="17.3137" width="16"
                                       height="2" rx="1"
                                       transform="rotate(-45 6 17.3137)"
                                       fill="black"/>
                                 <rect x="7.41422" y="6"
                                       width="16" height="2"
                                       rx="1"
                                       transform="rotate(45 7.41422 6)"
                                       fill="black"/>
                             </svg>
                         </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <!--begin::Form-->
                <form wire:submit.prevent="update" id="kt_modal_edit_card" class="form">
                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_create_api_key_header"
                             data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll"
                             data-kt-scroll-offset="300px">
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Color Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" wire:model="name" class="form-control form-control-solid"
                                       placeholder="Your Color Name" name="name"/>
                                @error('name')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label for="exampleColorInput" class="form-label">Enter Color:</label><br><br>
                                <div class="container">
                                    <input type="color" wire:model="hex" id="style1"/>
                                    <label for="style1">{{strtoupper($hex)}}</label>
                                </div>
                                <!--end::Input-->
                                @error('hex')
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
                        <button type="submit" wire:target="update" :disabled="$disabled" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Form-->
        <!--end::Modal body-->
    </div>
    <!--end::Modal - Edit product-->

    <!--begin::Modal - Create Api Key-->

    <!--begin::Modal - Delete Api Key-->
    <div wire:ignore.self class="modal fade" id="delete_color" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">

                <div style="text-align: right">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">

                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)"
                                          fill="black"/>
                                </svg>
                            </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Are you sure you want delete <span style="color: {{$hex}}">{{$name}}</span> color?</h2>
                    <form wire:submit.prevent="destroy" id="kt_modal_edit_card" class="form">
                        <!--begin::Modal body--> <!--begin::Modal footer-->
                        <div class="modal-footer flex-center">
                            <!--begin::Button-->
                            <button type="submit" wire:target="destroy" :disabled="$disabled" class="btn btn-danger">
                                <span class="indicator-label">Yes</span>
                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Modal footer-->
                    </form>
                    <!--end::Modal title-->
                </div>
                <!--end::Modal header-->
                <!--begin::Form-->

                <!--end::Form-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Api Key-->
</main>

@push('scripts_livewire')
    <script>
        window.addEventListener(`close-modal`, event => {
            $('#create_color').modal('hide');
            $('#edit_color').modal('hide');
            $('#delete_color').modal('hide');
        });
        // window.livewire.on('close-modal', function() {
        //     $('#create_color').modal('hide');
        //     $('#edit_color').modal('hide');
        //     $('#delete_color').modal('hide');
        // });
    </script>
@endpush
