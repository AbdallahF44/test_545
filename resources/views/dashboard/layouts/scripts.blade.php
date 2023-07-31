
@stack('scripts')
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('cpanel/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('cpanel/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('cpanel/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('cpanel/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('cpanel/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('cpanel/assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{asset('cpanel/assets/js/custom/modals/upgrade-plan.js')}}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->


@livewireScripts
<script src="{{ asset('livewire/livewire.js') }}" defer></script>
