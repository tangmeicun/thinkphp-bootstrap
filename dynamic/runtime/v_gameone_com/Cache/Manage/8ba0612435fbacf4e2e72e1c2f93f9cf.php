<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">编辑奖品</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">编辑奖品</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active in" id="home">
                        <form id="tab" method="post">
                            <input type="hidden" name="id" value="<?php echo ($data["info"]["id"]); ?>" class="input-xlarge">
                            <label>菜单名称</label>
                            <input type="text" name="title" value="<?php echo ($data["info"]["title"]); ?>" class="input-xlarge">
                            <label>奖品描述</label>
                            <input type="text" name="description" value="<?php echo ($data["info"]["description"]); ?>" class="input-xlarge">
                            <label>中奖百分比</label>
                            <input type="text" name="percent" value="<?php echo ($data["info"]["percent"]); ?>" class="input-xlarge">
                            <label>获取奖品积分数</label>
                            <input type="text" name="prize" value="<?php echo ($data["info"]["prize"]); ?>" class="input-xlarge">
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