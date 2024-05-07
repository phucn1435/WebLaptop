<div class="container">
    <?php 
     $originalQueryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

     // Parse the query string into an array of key-value pairs
     parse_str($originalQueryString, $params);
     
     // Initialize an empty array to store filtered parameters
     $filteredParams = [];
     
     // Iterate through the parsed parameters
     foreach ($params as $key => $value) {
       // Check if the key is not 'page' or 'per_page'
       if ($key !== 'page' && $key !== 'per_page') {
         // Add the unique key-value pair to the filtered array
         $filteredParams[$key] = $value;
       }
     }
     
     // Rebuild the query string without duplicates
     $url = http_build_query($filteredParams, '', '&', PHP_QUERY_RFC3986);
 
            if($current > 3) { 
            $first = 1; 
        ?>
        <a class="paging-link paging-link-first " href="?<?php echo isset($_GET['keyword']) ? "$url" : ""; ?>&per_page=<?=$item1;?>&page1=<?=$first?>">First</a>
        <?php }
        if($current > 1) {
            $prev = $current - 1; ?>
        <a class="paging-link" href="?<?php echo isset($_GET['keyword']) ? "$url" : ""; ?>&per_page=<?=$item1;?>&page=<?=$prev?>">Prev</a>
    <?php } ?>

    <?php
        for($num=1; $num<=$totalPage;$num++) { ?>
        <?php 
            if($num != $current) { ?>
        <?php 
            if($num > $current - 3 && $num < $current + 3) { ?>
        <a class="paging-link" href="?<?php echo isset($_GET['keyword']) ? "$url" : ""; ?>&per_page=<?=$item1;?>&page=<?=$num?>"><?=$num?></a>
        <?php } ?>
        <?php } else { ?>
        <strong class="paging-link-select"><?=$num?></strong>
        <?php } ?>
    <?php } ?>

    <?php 
            if($current < $totalPage - 1) {
            $next = $current + 1;
        ?>
            <a class="paging-link" href="?<?php echo isset($_GET['keyword']) ? "$url" : ""; ?>&per_page=<?=$item1;?>&page=<?=$next?>">Next</a>
        <?php } 
        if($current < $totalPage - 3) {
            $end = $totalPage; ?>
            <a class="paging-link paging-link-last" href="?<?php echo isset($_GET['keyword']) ? "$url" : ""; ?>&per_page=<?=$item1;?>&page=<?=$end?>">Last</a>
    <?php } ?>
</div>



