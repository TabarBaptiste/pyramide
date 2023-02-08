<?php 
require_once 'fonction.php'; 
if (isset($_POST['ajout'])){
    ajoutUser($_POST);
    print_r($_POST);

}
?>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="flash-message">
        <?php echo $_SESSION['flash'];
        print_r($_SESSION);
        print_r($_POST);
        ?>
    </div>
    <?php //unset($_SESSION['flash']); ?>
<?php endif; ?>