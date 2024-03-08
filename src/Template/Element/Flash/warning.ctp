<style>
.alert-warning {
    display: block; 
}
</style>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="alert alert-warning text-center" role="alert" style="margin-top: 56px; cursor: pointer;" 
onclick="hideWarning()">
    <?= $message ?>
</div>

<script>
    function hideWarning() {
        var warningDiv = document.querySelector('.alert-warning');
        if (warningDiv) {
            warningDiv.style.display = 'none';
        }
    }
</script>
