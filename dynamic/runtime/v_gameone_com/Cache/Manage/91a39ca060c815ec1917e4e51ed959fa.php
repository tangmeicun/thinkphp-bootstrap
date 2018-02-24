<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">菜单管理</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">奖品管理</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="well">
                <div id="toolbar">
                    <a class="btn btn-primary" href="<?php echo U('sheji/prizeadd');?>" role="button"><i class="icon-plus"></i>新增奖品</a>
                </div>
                <table id="table"
                       data-toolbar="#toolbar"
                       data-pagination="true"
                       data-search="true"
                       data-show-refresh="true"
                       data-show-toggle="true"
                       data-show-columns="true"
                       data-toggle="table"
                       data-page-list="[5, 15, 25, 25, ALL]"
                       data-height="2"
                       data-url="/manage/sheji/prizelist">
                    <thead>
                    <tr>
                        <!--<th data-field="id" data-checkbox="true"></th>-->
                        <th data-field="id">ID</th>
                        <th data-field="title">奖品标题</th>
                        <th data-field="percent">中奖百分比</th>
                        <th data-field="prize">获取奖品积分数</th>
                        <th data-field="operation">操作</th>
                    </tr>
                    </thead>
                </table>
            </div>

            <footer>
    <p>&copy; 2017 若水网络</p>
    <p>作者：Tmc</p>
</footer>

        </div>
    </div>
</div>