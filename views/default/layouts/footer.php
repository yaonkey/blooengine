<div class="page-buffer"></div>
</div>
<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-right"><a href="/contacts/"><i class="fa fa-phone"></i> Контакты</a></p>
                <p class="pull-left"><a href="../../../index.php"><i class="fa fa-envelope"></i> Написать</a>
                </p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->


<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/main.js"></script>
<script>
    $(document).ready(function() {
        $(".add-to-cart").click(function() {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/" + id, {}, function(data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

</body>

</html>