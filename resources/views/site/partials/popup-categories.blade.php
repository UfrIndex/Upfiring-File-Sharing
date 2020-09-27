<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach( $categories as $category)
                    @if( $category->name != 'x265 BluRay Encodes' )
                    <div class=""><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></div>
                    @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="close-modal btn btn-primary">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReportForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" id="formReport">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p>Send report</p>
                <button type="button" class="close close-modal-report-form" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                    <input type="hidden" name="idUfrFile" value="{{  $UfrFile->id ?? "" }}">
                    <select name="type" id="typeReport"  class="form-control">
                        <option value="Copyright Infringement">Copyright Infringement</option>
                        <option value="Explicit/Child Pornography">Explicit/Illegal Content</option>
                        <option value="Promoting Violence">Promoting Violence</option>
                        <option value="Other">Other</option>
                    </select>
                    <textarea name="OrderText" id="OrderText" cols="30" rows="10" style="display:none;" class="form-control textarea-modal-report"></textarea>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send</button>
                <button type="button" class="close-modal-report-form btn btn-primary">Cancel</button>
            </div>
        </div>
    </div>
    </form>
</div>



<script>
    $('#categoriesModal').on('click', function () {
        $('#exampleModal').toggleClass('show').toggle();
        $('body').css('overflow-y','hidden');
    });
    $('.close-modal').on('click', function () {
        $('#exampleModal').toggleClass('show').toggle();
        $('body').css('overflow-y','auto');
    });

    $('#ModalReportForm').on('click', function () {
        $('#modalReportForm').toggleClass('show').toggle();
        $('body').css('overflow-y','hidden');
    });
    $('.close-modal-report-form').on('click', function () {
        $('#modalReportForm').toggleClass('show').toggle();
        $('body').css('overflow-y','auto');
    });

    $('#typeReport').on('change', function() {
        var target = $('#typeReport option:selected').val();
        if(target == "Other") {
            $('.textarea-modal-report').show();
        }
        else {
            $('.textarea-modal-report').hide();
        }
    });


    $('#errorReport').click(function (e){
        $('#errorModal').toggleClass('show').toggle();
    });

    @isset($UfrFile)
    $('#formReport').submit(function (e){
        e.preventDefault();
        $('#modalReportForm').hide();
        send_report({{ $UfrFile->id ?? "" }}, $('select#typeReport').val(), $('textarea#OrderText').val());
        $('#ModalReportForm').hide();
    });
    @endisset
</script>


