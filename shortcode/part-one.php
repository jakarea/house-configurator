<?php
/**
 * @package  HouseConfigurator
 */
?>
<!-- add simple bootstrap card -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title">House Configurator</h5>
            </div>
            <div class="card-body">
                <form action="#" method="post" id="calculate_01">
                    <div class="form-group mb-3">
                        <label for="square_meters">Surface area in square metres</label>
                        <input type="number" class="form-control" id="square_meters" name="square_meters" placeholder="Enter square meters" value="20" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="levels">All Levels</label>
                        <select class="form-control" id="levels" name="levels" required>
                            <option value="basic">Basic</option>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_1" >
                            <label class="form-check-label" for="feature_1"> Wind and waterproof within 1 day</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_2" >
                            <label class="form-check-label" for="feature_2">Exterior finished</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_3" >
                            <label class="form-check-label" for="feature_3"> Hardwood or plastic frames</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_4" >
                            <label class="form-check-label" for="feature_4">Preparation electricity</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_5" >
                            <label class="form-check-label" for="feature_1"> Plumbing preparation</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_6" >
                            <label class="form-check-label" for="feature_2">Frames primed</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_7" >
                            <label class="form-check-label" for="feature_3"> Light partitions</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_8" >
                            <label class="form-check-label" for="feature_4">Wall sockets & light points</label>
                        </div>
                        <div class="form-check form-check-inline col-md-12">
                            <input class="form-check-input" type="checkbox" name="feature_list[]" id="feature_9" >
                            <label class="form-check-label" for="feature_9">Heating, toilet & sanitary</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-5 shadow-sm">
            <div class="card-body text-center">
                <div class="card-title">
                    <h4 class="mb-3">Result</h4>
                </div>
                <div class="badge badge-primage bg-danger">
                    <h3 class="mb-0 cal__result">0</h3>
                </div>
            </div>
        </div>
    </div>
</div>
