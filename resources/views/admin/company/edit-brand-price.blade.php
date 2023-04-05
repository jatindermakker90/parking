<div>
    <div class="row">
        @foreach ($days_price as $days_price_key => $days_price_value)
            <div class="col-2 mb-3">
                <label>{{ ucfirst($days_price_key) }}</label>
                <select class="form-control select2" style="width: 100%;" name="days_price[{{$days_price_key}}]">
                    <option value="">Select airport</option>
                </select>
            </div>
        @endforeach
        <div class="col-2 mb-3">
            <label>After 30 days</label>
            <select class="form-control select2" style="width: 100%;" name="days_price[after_30]">
                <option value="4">4</option>
            </select>
        </div>
    </div>
    <div>
        <input class="mr-2" type="checkbox" name="status" id="modal_status" <?= ($status) ? 'checked': '' ?> > Active Brand        
    </div>
</div>