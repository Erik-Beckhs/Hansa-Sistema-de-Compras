<?php

require_once('include/MVC/View/views/view.html.php');

#customAOS_ProductsViewPlan_inventario
class SCO_ConsolidacionViewCreacion extends ViewHtml
{
    public function display(){

	   	$head = '	   	   		
				<link rel="stylesheet" href="modules/SCO_Consolidacion/consolidacion.css?'.time().'" type="text/css" />	 
				<link rel="stylesheet" href="modules/SCO_Consolidacion/consolidacionProductosList.css?'.time().'" type="text/css" />	 
	   			<link href="modules/SCO_Consolidacion/smart_wizard_all.css?'.time().'" rel="stylesheet" type="text/css" />
	   			<link href="modules/SCO_Consolidacion/css-loader.css?'.time().'" rel="stylesheet" type="text/css" />  		   			
	   			';
	   			
	   	$head .= '<div class="moduleTitle">
				<h2 class="module-title-text"> Crear </h2>
				<span class="utils"></span><div class="clear"></div></div>
				<div class="loader loader-default" data-text="Enviando datos"></div>
				';		

		$steps = '
				<!-- SmartWizard html -->
				<div id="smartwizard">
				    <ul class="nav">
				        <li class="nav-item">
				          <span class="nav-link" href="#step-1">
				           Consolidacion
				          </span>
				        </li>
				        <li class="nav-item">
				          <span class="nav-link" href="#step-2">
				      		Orden de Compra
				          </span>
				        </li>            
				    </ul>
				    <div class="tab-content">
				        <div id="step-1" class="tab-pane consolidacionProductos" role="tabpanel" aria-labelledby="step-1">
								<div class="container-fluid">
									<div class="row filtro">
										<div class="col-sm-2">
											<div class="input-group">
												<div class="input-group">
													<span class="input-group-addon">Fabricante</span>
													<select class="form-control filter" id="idFabricante" name="idFabricante">
														<option value="" selected="selected">Todo</option>
														</select>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="input-group" style="display: flex;">
												<div class="input-group">
													<span class="input-group-addon">Nro. cotizaci&oacute;n: </span>
													<input typw="text" class="form-control filter" id="nroCotizacion" name="nroCotizacion">
													
													<!-- select class="form-control filter" id="nroCotizacion" name="nroCotizacion">
														<option value="" selected="selected">Todo</option>
														<div id="nroCotizacionOption"></div>
													</select -->
												</div>
											</div>
											<div class="buscador">
												<button class="btn btn-info btn-sm" onclick="buscar()">
													<i class="glyphicon glyphicon-search"></i>
												</button>
											</div>											
										</div>										
										<div class="col-sm-2">
											<div class="input-group">
												<div class="input-group">
													<span class="input-group-addon">Plazo entrega</span>
													<select class="form-control filter" id="plazoEntrega" name="plazoEntrega">
														<option value="" selected="selected">Todo</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="input-group">
												<div class="input-group">
													<span class="input-group-addon">Cod. Proveedor</span>
													<select class="form-control filter" id="codAioProduct" name="codAioProduct">
														<option value="" selected="selected">Todo</option>
														<div id="codAioProductOption"></div>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="input-group">
												<div class="input-group">
													<span class="input-group-addon">Cliente</span>
													<select class="form-control filter" id="idCliente" name="idCliente">
														<option value="" selected="selected">Todo</option>
													</select>
												</div>
											</div>
										</div>										
									</div>
											
									<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalMensaje">
										<div class="modal-dialog modal-md" role="document">
											<div class="modal-content">
												<div class="modal-header" style="background:#a94442 !important;">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">Ã—</span></button>
												<h4 class="modal-title" id="tituloMensaje"></h4>
												</div>
												<div class="modal-body">
													<div class="alert alert-danger">
													    <div id="mensajeModal"></div>
													</div>		
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 table-responsive">
											<div class="panel panel-success">
								                <div class="panel-heading">
								                    <center>Productos Cotizados CRM Ventas</center>
								                </div>
								                <div class="panel-body">
								                    <div class="totales">
														<div class="cantidades1">						
															<label>Total FOB</label> <input type="number" id="totalFob1" value="0"> 
															<label>Cant. Total</label> <input type="number" id="cantidadTabla1" value="0">
                              <label>Cant. items</label> <span id="cantRegistro"></span>
														</div>
														<button class="btn derecha" onclick="enviarTodo()">>></button>
													</div>
													<table class="table view table-responsive tableCotizacion table-striped table-bordered">
														<thead>
															<tr>
																<th>Nro. Cont</th>
																
																<th>Cod. Proveedor</th>
																<th>Fabricante</th>
																<th>Descipci&oacute;n</th>
																<th>Vendedor</th>
																<th>Cliente</th>
																<th>Fecha confirmacion</th>
																<th>Cant.</th>
																<th>FOB</th>
																
																<th>Sub Total</th>
																<th></th>
															</tr>
														</thead>
														<tbody id="tabla1">
														</tbody>
													</table>
								                </div>
								            </div> 
											
										</div>
										<div class="col-md-6 table-responsive">
											<div class="panel panel-info">
					                            <div class="panel-heading">
					                                <center>Productos Consolidados</center>
					                            </div>
					                            <div class="panel-body">					                 
				                                     <div class="totales">
														<button class="btn izquierda" onclick="regresarTodo()"><<</button>
														<div class="cantidades2">
														<label>Total FOB</label> <input type="number" id="totalFob2" value="0"> 
														<label>Cant. Total</label> <input type="number" id="cantidadTabla2" value="0">
                            <label>Cant. items</label> <span id="cantRegistro2"></span>
														</div>	
													</div>
													<table class="table view table-responsive tableCotizacion table-striped table-bordered">
														<thead>
															<tr>
															<th>Nro. Cont</th>
															
															<th>Cod. Proveedor</th>
															<th>Fabricante</th>
															<th>Descipci&oacute;n</th>
															<th>Vendedor</th>
															<th>Cliente</th>
															<th>Fecha confirmacion</th>
															<th>FOB</th>
															<th>Cant.</th>
															<th>Sub Total</th>
															<th></th>
															</tr>
														</thead>
														<tbody id="tabla2">
														</tbody>
													</table>					                            
					                            </div>
					                        </div>   
											
										</div>
									</div>
								</div>
				        </div>
				        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">		
				        	  <div id="ordeCompra"><div>	
				        	  <div id="ventanaModal"></div>		            
				        </div>
				    </div>
				</div>
				';

       	
      	$footer = '
				<script type="text/javascript" src="modules/SCO_Consolidacion/jquery.smartWizard.js?'.time().'"></script> 
				<script src="modules/SCO_Consolidacion/consolidacion.js?'.time().'"></script>				    			
    			<script src="modules/SCO_Consolidacion/consolidacionProductosList.js?'.time().'"></script>
    			<script src="modules/SCO_Consolidacion/jquery.validate.js?'.time().'"></script>
				<script type="text/javascript">
				    $(document).ready(function(){
				        // Toolbar extra buttons
				        var btnFinish = $("<button></button>").text("Finish")
				                                         .addClass("btn btn-info")
				                                         .on("click", function(){ alert("Finish Clicked"); });
				        var btnCancel = $("<button></button>").text("Cancel")
				                                         .addClass("btn btn-danger")
				                                         .on("click", function(){ $("#smartwizard").smartWizard("reset"); });

				        // Step show event
				        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
				            $("#prev-btn").removeClass("disabled");
				            $("#next-btn").removeClass("disabled");
				            if(stepPosition === "first") {
				                $("#prev-btn").addClass("disabled");
				            } else if(stepPosition === "last") {
				                $("#next-btn").addClass("disabled");
				            } else {
				                $("#prev-btn").removeClass("disabled");
				                $("#next-btn").removeClass("disabled");
				            }
				        });

				        // Smart Wizard
				        $("#smartwizard").smartWizard({
				            selected: 0,
				            theme: "arrows", //default, arrows, dots, dark
				            transition: {
				                animation: "slide-swing", // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
				            },
				            toolbarSettings: {
				                toolbarPosition: "both" // both bottom
				                //toolbarExtraButtons: [btnFinish, btnCancel]
				            }
				        });

				        // External Button Events
				        $("#reset-btn").on("click", function() {
				            // Reset wizard
				            $("#smartwizard").smartWizard("reset");
				            return true;
				        });

				        $("#prev-btn").on("click", function() {
				            // Navigate previous
				            $("#smartwizard").smartWizard("prev");
				            return true;
				        });

				        $("#next-btn").on("click", function() {
				            // Navigate next
				            $("#smartwizard").smartWizard("next");
				            return true;
				        });


				        // Demo Button Events
				        $("#got_to_step").on("change", function() {
				            // Go to step
				            var step_index = $(this).val() - 1;
				            $("#smartwizard").smartWizard("goToStep", step_index);
				            return true;
				        });

				        $("#is_justified").on("click", function() {
				            // Change Justify
				            var options = {
				              justified: $(this).prop("checked")
				            };

				            $("#smartwizard").smartWizard("setOptions", options);
				            return true;
				        });

				        $("#animation").on("change", function() {
				            // Change theme
				            var options = {
				              transition: {
				                  animation: $(this).val()
				              },
				            };
				            $("#smartwizard").smartWizard("setOptions", options);
				            return true;
				        });

				        $("#theme_selector").on("change", function() {
				            // Change theme
				            var options = {
				              theme: $(this).val()
				            };
				            $("#smartwizard").smartWizard("setOptions", options);
				            return true;
				        });

				    });
				</script>
    			';
       
		echo $head.$steps.$footer;

    }
}
