<?php
$tableKeys = [];
?>
<div class="row" style="padding-top: 10px;">
    <form class="form-horizontal" method="POST" action="<?=URL?>home/importXmlData" role="form">
	  <div class="bs-component">
		<div class="form-group has-primary">
		    <label class="col-md-3 control-label" for="inputPrimary">Enter RSS URL</label>
		    <div class="col-md-6">
			  <input type="text" name="rssUrl" class="form-control" id="rssUrl">
		    </div>
		    <button type="submit" class="btn btn-primary">Import</button>
		</div>
	  </div>
    </form>
</div>
<section id="content" class="table-layout animated fadeIn">
    <?php foreach ($data as $key => $rssInfo): ?>
	  <?php $tableKeys[] = $key; ?>
        <div class="row" id="spy<?= $key ?>">
		<div class="col-md-12">
		    <div class="panel">
			  <div class="panel-body pn">
				<div class="bs-component">
				    <h2><?= $rssInfo[0]['fi_title'] ?></h2>
				    <table class="table" id="datatable<?= $key ?>">
					  <thead>
						<tr class="primary">
						    <th>#</th>
						    <th>Author Name</th>
						    <th>Title</th>
						    <th>Summary</th>
						</tr>
					  </thead>
					  <tbody>
						    <?php foreach ($rssInfo as $rss): ?>
							<tr>
							    <td><?= $rss['id'] ?></td>
							    <td><?= $rss['author_name'] ?></td>
							    <td><a href="<?= $rss['uri'] ?>" target="_blank"><?= $rss['title'] ?></a></td>
							    <td><?= html_entity_decode($rss['summary']) ?></td>
							</tr>
						    <?php endforeach; ?>
					  </tbody>
				    </table>
				</div>
			  </div>
		    </div>
		</div>
        </div>
    </section>
<?php endforeach; ?>
<?php foreach ($tableKeys as $keys): ?>
    <?php $this->addScript('
    $(document).ready(function () {
	  $("#datatable' . $keys . '").dataTable({
		"aoColumnDefs": [{
			  "bSortable": false,
			  "aTargets": [-1]
		    }],
		"oLanguage": {
		    "oPaginate": {
			  "sPrevious": "",
			  "sNext": ""
		    }
		},
		"iDisplayLength": 5,
		"aLengthMenu": [
		    [5, 10, 25, 50, -1],
		    [5, 10, 25, 50, "All"]
		]
	  });
    });
	  ');
    ?>
<?php endforeach; ?>