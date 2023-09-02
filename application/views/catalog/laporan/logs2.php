<script>
/*$(document).ready(function() {
        $('#pirate_table').DataTable( {
            "processing": true,
            "serverSide": true,
            "bPaginate": true,
            "ajax": function(data, callback, settings) {
                    $.get('http://localhost/api/api/logs', {
                        limit: data.length,
                        offset: data.start,
                        }, function(res) {
                            callback({
                                recordsTotal: res.count,
                                recordsFiltered: res.count,
                                data: res.results
                            });
                        });
            },
            "columns": [
                { "data": "logtime" },
				{ "data": "user_id" },
				{ "data": "nip" },
				{ "data": "nama_lengkap" },
				{ "data": "ipadd" },
				{ "data": "browser" },
				{ "data": "os" },
				{ "data": "logdetail" }
            ]
        } );
    });*/
	$(document).ready(function() {
    $('#pirate_table').DataTable( {
        "ajax": "http://localhost/api/api/logs/"
        /*"columns": [
            { "data": "logtime" },
            { "data": "user_id" },
			{ "data": "nip" },
			{ "data": "nama_lengkap" },
			{ "data": "ipadd" },
			{ "data": "browser" },
			{ "data": "os" },
			{ "data": "logdetail" }
        ]*/
    } );
} );
</script>
<div class="content-wrapper">
 
  <div class="content">
    
    <div class="row">
      
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="fa fa-user-secret" aria-hidden="true"></i> Data Action Logs</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

        </div>

        <table id="pirate_table" class="table display dataTable" width="100%">
          <thead>
            <tr>
              <th>Log Time</th>
			  <th>User ID</th>
              <th>NIP</th>
			  <th>Nama Lengkap</th>
			  <th>IP Address</th>
			  <th>Browser</th>
			  <th>OS</th>
			  <th>Action</th>
            </tr>
          </thead>
		  <!--<tbody>
              <?php
              $no = 1;
			  //if(is_array($logs)){
			  $result = array_reverse($logs->data);
              foreach ($result as $baris) {
              ?>
                <tr>
                  <td><?php echo $no.'.'; ?></td>
                  <td><?php echo date_indo_bk($baris->logtime); ?></td>
				  <td><?php echo $baris->user_id; ?></td>
				  <td><?php echo $baris->nip; ?></td>
				  <td><?php echo $baris->nama_lengkap; ?></td>
				  <td><?php echo $baris->ipadd; ?></td>
				  <td><?php echo $baris->browser; ?> <?php echo $baris->browser_version; ?></td>
				  <td><?php echo $baris->os; ?></td>
				  <td><?php echo $baris->logdetail; ?></td>
                </tr>
              <?php
              $no++;
             // } 
			  }?>
          </tbody>-->
        </table>
      </div>
      
    </div>
  
