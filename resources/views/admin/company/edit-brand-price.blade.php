<input type="hidden" name="id" value="{{ $id }}">
<div>
    <div class="row">
        @foreach ($days_price as $days_price_key => $days_price_value)
            <div class="col-2 mb-3">
                <label>{{ ucfirst($days_price_key) }}</label>
                <input type="number" class="form-control" placeholder="Price"
                           name="days_price[{{$days_price_key}}]"
                          value="{{ $days_price_value ?? '' }}">
            </div>
        @endforeach
        <div class="col-2 mb-3">
            <label>After 30 days</label>
            <input type="number" class="form-control" placeholder="Price"
                           name="after_30_days"
                          value="{{ $after_30_days ?? '' }}">
        </div>
    </div>
    <div>
        <input class="mr-2" type="checkbox" name="status" value="1" <?= ($status) ? 'checked': '' ?> > Active Brand        
    </div>
</div>