@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="form-appl">
            <div class="title-class">
                <h2>Submit Your Application</h2>
            </div>
            <div class="error" id="message"></div>

            <form id="frmAppl" class="frmAppl">
                @csrf
                <div class="form-group col-md-12 mb-3">
                    <label for="">Your Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Name">
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="">Your Email</label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="Enter Your Email">
                </div>
                <div class="form-group col-md-12 mb-5">
                    <label for="">Address</label>
                    <textarea class="form-control" name="address" id="address" cols="90" rows="3"
                        placeholder="Enter Your Address"></textarea>
                </div>

                <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="showMsg">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center;">
                <h4>Thank you for submitting the form</h4>
            </div>
            <div class="modal-footer" style="border: none;">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script>       
$("#frmAppl").on("submit", function(event) {
    event.preventDefault();
    var error_ele = document.getElementsByClassName('err-msg');
    if (error_ele.length > 0) {
        for (var i=error_ele.length-1;i>=0;i--){
            error_ele[i].remove();
        }
    }
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
   
    $.ajax({
        url: "{{ route('application.store') }}",
        type: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            $("#submitBtn").prop('disabled', true);
        },
        success: function(data) {
            if (data.success) {
                $("#frmAppl")[0].reset();
                $("#showMsg").modal('show');
                
            } 
            else {
                $.each(data.error, function(key, value) {
                    var el = $(document).find('[name="'+key + '"]');
                    el.after($('<span class= "err-msg">' + value[0] + '</span>'));
                    
                });
            }
            $("#submitBtn").prop('disabled', false);
        },
        error: function (err) {
            $("#message").html("Some Error Occurred!")
            }
        });
    });
</script>

@endpush
