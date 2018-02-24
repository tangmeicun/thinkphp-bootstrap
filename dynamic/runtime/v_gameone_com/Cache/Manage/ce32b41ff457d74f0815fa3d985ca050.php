<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">新增奖品</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">新增奖品</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="home">
                        <form id="tab" method="post">
                            <label>奖品名称</label>
                            <input type="text" name="title" value="" class="input-xlarge">
                            <label>奖品描述</label>
                            <input type="text" name="description" value="" class="input-xlarge">
                            <label>中奖百分比</label>
                            <input type="text" name="percent" value="" class="input-xlarge">(例:50)
                            <label>获取奖品积分数</label>
                            <input type="text" name="prize" value="" class="input-xlarge">(例:150)
                            <label></label>
                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i>  提交</button>
                        </form>
                    </div>
                </div>
            </div>

            <footer>
    <p>&copy; 2017 若水网络</p>
    <p>作者：Tmc</p>
</footer>

        </div>
    </div>
</div>