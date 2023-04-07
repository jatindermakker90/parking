@if($is_exist)
    <h1>brands exist</h1>
@else
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="company_id" value="{{ $company_id }}">
    <div>
        <div class="row">
            <label>Select Price Brand againt each day</label>
            <select type="number" class="form-control select2" style="width: 100%;margin-bottom:20px;">
                <option value="">Apply same brand to all</option>
                @foreach($gettAllBands as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->brand }}</option>
                @endforeach
            </select>
        </div>
        <div class="row mt-3">
            @for($i=1; $i<=31; $i++)
                <div class="col-2 mb-3">
                    <label>day_{{$i}}</label>
                    <select type="number" class="form-control select2" name="days_price[day_{{$i}}][id]" style="width: 100%;">
                            @foreach($gettAllBands as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->brand }}</option>
                            @endforeach
                    </select>
                </div>
            @endfor
        </div>
    </div>
@endif