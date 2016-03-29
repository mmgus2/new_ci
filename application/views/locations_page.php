<div class="container marketing" style="margin-top: 90px;">
    <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <form class="form-inline" role="form" method="post" action="Locations">
                <div class="form-group">
                    <label for="distance">Max Distance</label>
                    <input type="number" class="form-control" name="distance" />
                </div>
                <div class="form-group">
                    <select class="form-control" name="unit">
                        <option value="K" selected>Kilometers</option>
                        <option value="M">Miles</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Apply</button>
            </form>
        </div>
        <div class="col-xs-3"></div>
    </div>
    <br />
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <?php echo $map['html']; ?>
        </div>
        <div class="col-xs-1"></div>
    </div>
</div>
<br />
