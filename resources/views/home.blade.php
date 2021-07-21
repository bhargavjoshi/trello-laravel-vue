@extends('layout/index')

@section('page-content')
    <div id="main"></div>
@endsection

@push('page-js')
    <script type="application/javascript">
        new Vue({
            el: '#main',
            template: '<app/>'
        });
    </script>
@endpush
