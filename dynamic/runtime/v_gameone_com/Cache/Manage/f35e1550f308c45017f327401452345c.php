<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">用户消费获奖记录管理</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">积分记录管理</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="well">
                <div id="toolbar">
                    <a class="btn btn-primary" role="button"><i class="icon-plus"></i>积分列表</a>
                </div>
                <table id="table"
                       data-toolbar="#toolbar"
                       data-pagination="true"
                       data-search="true"
                       data-show-refresh="true"
                       data-show-toggle="true"
                       data-show-columns="true"
                       data-toggle="table"
                       data-page-list="[15, 25, 50, ALL]"
                       data-height="2"
                       data-url="/manage/sheji/recordlist">
                    <thead>
                    <tr>
                        <!--<th data-field="id" data-checkbox="true"></th>-->
                        <th data-field="id">ID</th>
                        <th data-field="userid">用户id</th>
                        <th data-field="username">用户名</th>
                        <th data-field="prizename">游戏操作名</th>
                        <th data-field="prizenum">消费获取奖品积分数</th>
                        <th data-field="status">扣减或获得</th>
                        <th data-field="datetime">操作时间</th>
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