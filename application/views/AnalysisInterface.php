<div class="container-lg pb-5 px-lg-5 my-5">
    <?php if (isset($scan) && is_array($scan) && $scan != false) { ?>
        <div class="row mx-lg-5 border-bottom mb-1">
            <div class="col">
                <h1 class="display-4">Scan Result</h1>
            </div>
            <div class="col-2 text-end m-auto">
                <a href="#" class="btn btn-outline-secondary" onclick="window.print();"><i class="fas fa-print fa-fw fa-sm"></i> Print</a>
            </div>
        </div>
        <div class="row mx-lg-5 pb-4">
            <div class="col-12 col-lg-4 border-end pe-2">
                <small class="text-muted">RESULT</small>
                <?php if ($scan['errors'] == 0) { ?>
                    <p class="text-success">Your file is good, no possible SQL injection flaws detected.</p>
                <?php } else { ?>
                    <p class="text-danger"><?php echo $scan['errors']; ?> Warning(s) detected!</p>
                <?php } ?>
                <small class="text-muted">FILE NAME</small>
                <p><?php echo $scan['file']; ?></p>
                <small class="text-muted">TIME TAKEN</small>
                <p><?php echo $scan['time']; ?> second(s)</p>
                <small class="text-muted">DATE SCANNED</small>
                <p><?php echo $scan['date']; ?></p>
                <div class="pb-1">
                    <a href="<?php echo base_url(); ?>history" class="btn btn-sm btn-primary"><i class="fas fa-history fa-fw fa-sm"></i> View History</a>
                    <a href="<?php echo base_url(); ?>history" class="btn btn-sm btn-outline-secondary"><i class="fas fa-upload fa-fw fa-sm"></i> Update Code</a>
                </div>
            </div>
            <?php if (isset($scan['history']) && is_array($scan['history']) && $scan['history'] != false) {
                $values = [];
                foreach ($scan['history'] as $history) {
                    array_push($values, (int)$history['ad_total_error']);
                }
            ?>
                <div class="col-12 col-lg-8 ps-2">
                    <div id="myChart" class="h-100 w-100" style="min-height: 50vh;"></div>
                    <script>
                        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
                        var myConfig = {
                            "type": "line",
                            title: {
                                "text": "Last 10 Analyzed Result Comparison"
                            },
                            backgroundColor: 'none',
                            plotarea: {
                                backgroundColor: 'transparent'
                            },
                            "scale-y": {
                                "line-color": "#f6f7f8",
                                "guide": {
                                    "line-style": "dashed"
                                },
                                "label": {
                                    "text": "Warning(s) Detected",
                                },
                                "minor-ticks": 0,
                                "thousands-separator": ","
                            },
                            "scale-x": {
                                "min-value": 1,
                                "max-value": 10,
                                "label": {
                                    "text": "Uploaded Source Code",
                                },
                            },
                            "series": [{
                                "values": <?php echo json_encode($values); ?>
                            }]
                        };

                        zingchart.render({
                            id: 'myChart',
                            data: myConfig,
                            height: "100%",
                            width: "100%"
                        });
                    </script>
                </div>
            <?php } else { ?>
                <div class="col-12 col-lg-8 border-end pe-2">
                    <small class="text-muted">No previous data yet.</small>
                </div>
            <?php } ?>
        </div>
        <?php if ($scan['data'] != false) {
            foreach ($scan['data'] as $data) {  ?>
                <div class="row mx-lg-5 pb-2">
                    <div class="col">
                        <div class="card rounded-3 border-0 shadow h-100">
                            <div class="card-header bg-warning ">
                                <p class="mb-0 fw-normal" style=" letter-spacing: 1px;" >
                                    <i class="fas fa-exclamation-triangle fa-fw fa-sm me-1"></i>
                                    POSSIBLE SQL INJECTION IN YOUR CODE
                                </p>
                            </div>
                            <div class="card-body d-inline-flex">
                                <div class="pe-3 border-end">
                                    <small class="text-muted">LINE</small>
                                    <p class="mb-0"><?php echo $data['line']; ?></p>
                                </div>
                                <div class="ps-3">
                                    <small class="text-muted">CODE</small>
                                    <p class="mb-0"><?php echo $data['content']; ?></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">DESCRIPTION</small>
                                <p class="mb-0"><?php echo $data['desc']; ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">EXAMPLE CODE FIX</small>
                                <p class="mb-0"><?php echo $data['code']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row mx-lg-5 pb-2 pt-2 border-top mt-3">
                <div class="col">
                    <h1 class="display-6">End of result.</h1>
                </div>
            </div>
    <?php
        }
    } ?>
</div>