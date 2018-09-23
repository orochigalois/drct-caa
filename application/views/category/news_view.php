<!-- 主内容开始 -->
<div class="ny_nav_bg_1 fix">
    <div class="ny_nav container fix">
        <div class="ny_nav_l_1 fix">
           <?php echo $cateList;?>
        </div>
        <div class="ny_nav_r fix">
            <span>您当前所在位置：</span>
            <?php echo $position;?>
        </div>
    </div>
</div>
<div class="ny_d2_k container">
    <h3><?php echo $detail['title'];?></h3>
    <div class="ny_d2_sp">
        <span class="ny_d2_sp1"><?php echo date("d F Y",$detail['addtime']);?></span>
        <span class="ny_d2_sp2"><?php echo $detail['source'];?></span>
    </div>
    <div>
    	<?php echo $detail['con_1'];?>
    </div>
    <div class="ny_page fix">
        <div class="row fix">
            <div class="col-md-6 fix">
                <p>上一篇：<?php echo $prev;?></p>
            </div>
            <div class="col-md-6 fix">
                <p>下一篇：<?php echo $next;?></p>
            </div>
        </div>
    </div>
</div>

<!-- 主内容结束 -->
