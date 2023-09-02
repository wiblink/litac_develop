<script src="<?php echo base_url();?>assets/js/orgchart.js"></script>
<div class="content-wrapper">
 
  <div class="content">
    
    <div class="row">
      
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="fa fa-user-secret" aria-hidden="true"></i> <?php echo $judul_web;?></h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

        </div>

        <div style="width:100%; height:700px;" id="jabatanorg"/>
		
		
      </div>
      
    </div>
      <script>
		/*OrgChart.templates.ana.field_0 = '<text class="field_0"  text-overflow="multiline" style="font-size: 20px;font-weight:bold;" fill="#ffffff" x="125" y="30" text-anchor="middle">{val}</text>';*/
		OrgChart.templates.ana.field_0 = '<text class="field_0" width="230" text-overflow="multiline" style="font-size: 20px;" fill="#ffffff" x="125" y="30" text-anchor="middle">{val}</text>';
        OrgChart.templates.ana.field_1 = '<text width="230" text-overflow="ellipsis" style="font-size: 14px;" fill="#ffffff" x="125" y="80" text-anchor="middle">{val}</text>';
        OrgChart.templates.ana.field_2 = '<text class="field_2"  style="font-size: 14px;" fill="#ffffff" x="125" y="100" text-anchor="middle">NIP: {val}</text>';

        var chart = new OrgChart(document.getElementById("jabatanorg"), {
			template: "ana",
			scaleInitial: OrgChart.match.width,
            layout: OrgChart.treeRightOffset,
            enableSearch: false,
            nodeBinding: {
                field_0: "jabatan",
                field_1: "nama_lengkap",
				field_2: "nip",
                img_0: "img"
            },
			linkBinding: {
				field_0: "createdAt"
			},    
            nodes: <?php echo $jabatan;?>
        });
    </script>
