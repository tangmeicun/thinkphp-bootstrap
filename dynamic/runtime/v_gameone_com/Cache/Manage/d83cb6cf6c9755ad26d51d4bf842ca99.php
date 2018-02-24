<?php if (!defined('THINK_PATH')) exit();?><div class="content">
    <div class="header">
        <h1 class="page-title">用户管理</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo U('index/index');?>">首页</a> <span class="divider">/</span></li>
        <li class="active">用户管理</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="well">
                <div id="toolbar">
                    <a class="btn btn-primary" href="<?php echo U('manager/useradd');?>" role="button"><i class="icon-plus"></i>新增管理员</a>
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
                       data-url="/manage/manager/userlist">
                    <thead>
                    <tr>
                        <!--<th data-field="id" data-checkbox="true"></th>-->
                        <th data-field="id">用户id</th>
                        <th data-field="username">登录名</th>
                        <th data-field="rolename">角色</th>
                        <th data-field="email">Email</th>
                        <th data-field="tel">Tel</th>
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