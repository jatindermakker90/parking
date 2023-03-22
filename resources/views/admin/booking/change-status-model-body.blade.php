<div>
    <input type="hidden" name="booking_id" value="{{ $id }}">
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control select2" style="width: 100%;" name="status" id="status">
            @foreach(config('constant.BOOKING_STATUS') as $status_key => $status_value)
                <option value="{{$status_value}}" <?php echo ($booking_status == $status_value)  ? 'selected' : '' ?>>{{$status_key}}</option>
            @endforeach
        </select>
        <span class="validationFail">Please select status</span>
    </div>`
</div>