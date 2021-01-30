<div class="card-body" wire:ignore>
    <div class="form-group">
        <label for="">Select A Oil Portfolio</label>
        <select class="form-control" name="portfolio_id" id="portfolio_id" required>
            <option></option>
            @foreach ($portfolios as $portfolio)
            <option value='{{ md5($portfolio->id )}}'>{{ $portfolio->title }}</option>
            @endforeach
        </select>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#portfolio_id').select2({
            placeholder: 'Select A Portfolio'
        });
    });
    $('#portfolio_id').on('select2:select', function (e) {
        @this.call('updateValues', $(this).val());
    });

</script>
@endpush
