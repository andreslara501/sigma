<template>
	<div id="content_basic" class="container">
		<div id="intro">
			<img src="../assets/logo.png">
			<h1>Prueba de desarrollo Sigma</h1>
			<p>
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
				industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
				scrambled it to make a type specimen book.
			</p>
		</div>
		<b-row id="form">
			<b-col
				md="12"
				lg="6"
			>
				<img src="../assets/aside.png">
			</b-col>
			<b-col
				md="12"
				lg="6"
			>
				<b-form
					v-if="!loading"
					@submit.stop.prevent="sendForm"
				>
					<b-form-group
						label="Departamento*"
						label-for="department"
					>
						<b-form-select
							id="department"
							v-model="department"
							:options="form.departments"
							@change="loadCities()"
							required
						>
						</b-form-select>
					</b-form-group>

					<b-form-group
						label="Ciudad*"
						label-for="city"
						:style="(form.cities.length) ? '' : 'opacity:0.3'"
					>
						<b-form-select
							id="city"
							v-model="city"
							:options="form.cities"
							required
							:disabled="(form.cities.length) ? false : true"
						></b-form-select>
					</b-form-group>

					<b-form-group
						label="Nombre*"
						label-for="name"
					>
						<b-form-input
							id="name"
							v-model="name"
							type="text"
							required
							placeholder="Pepito de Jesús"
						>
						</b-form-input>
					</b-form-group>

					<b-form-group
						label="Correo*"
						label-for="email"
					>
						<b-form-input
							id="email"
							v-model="email"
							type="email"
							required
							placeholder="Pepitodejesus@gmail.com"
						></b-form-input>
					</b-form-group>

					<div class="text-center">
						<b-button
							type="submit"
							variant="danger"
						>
							Enviar
						</b-button>
					</div>
				</b-form>

				<div v-else>
					<!--Loading-->
					<div style="text-align: center">
						<div class="loadingio-spinner-spinner-1het1da0yf6">
							<div class="ldio-jbpl07zppk">
								<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
							</div>
						</div>
					</div>
				</div>
			</b-col>
		</b-row>
	</div>
</template>

<script>
import axios from "axios";

export default {
	name: 'HelloWorld',

	data () {
		return {
			config:{
				urlDepartments: 'http://lara.com.co/colombia.php',
				urlApi:			'http://lara.com.co/api.php'
			},

			form: {
				departmentsCity:	[],
				departments:		[],
				cities:				[],
			},

			department:	'',
			city:		'',
			name:		'',
			email:		'',

			loading:	false
		}
	},
	mounted(){
		axios.get(this.config.urlDepartments)
		.then(response => {
			this.form.departmentsCitys 	= response.data;

			for (let department in response.data) {
				this.form.departments.push(department);
			}
		})
		.catch(error => {
			console.error(error);
		})
	},
	methods:{
		loadCities: function(){
			for (let department in this.form.departmentsCitys) {
				if(department === this.department){
					this.form.cities = this.form.departmentsCitys[department];
				}
			}
		},
		sendForm: function(){
			this.loading = true;
			axios.post(this.config.urlApi,{
				token:		'dvpitfoclvkbmmwnwgyolkfyqqdqvgcm',
				name:		this.name,
				email:		this.email,
				state:		this.department,
				city:		this.city
			})
			.then(response => {
				this.loading = false;

				this.name = 		'';
				this.email = 		'';
				this.department = 	'';
				this.city = 		'';

				this.form.cities = 	[];

				this.$bvModal.msgBoxOk('Tu información ha sidorecibida satisfactoriamente', {
					title: '¡Gracias!',
					okVariant: 'success',
					centered: true
				})
			})
			.catch(error => {
				console.error(error);
			})
		}
	}
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss">
	#content_basic{
		margin-top: 63px;
	}
		#intro{
			text-align: center;
			img{
				margin-bottom: 42px;
			}
			h1{
				font-size: 38px;
				margin-bottom: 37px;
			}
			p{
				font-size: 21px;
				line-height: 26px;
				color: #727071;
				width: 85%;
				display: inline-block;
				margin-bottom: 55px;
			}
		}
		#form{
			margin-bottom: 50px;
			img{
				width: 100%;
			}
			form{
				padding: 65px 57px;
				box-shadow: rgba(0,0,0,0.2) 2px 2px 25px;
				border-radius: 15px;
				height: 100%;
			}
				.form-group{
					margin-bottom: 25px;
				}
					label{
						font-size: 20px;
						font-weight: bold;
					}
						select{
							font-size: 20px;
							border-radius:8px;
							background: url('../assets/arrow.png') no-repeat right 14px center  !important;
						}
						input{
							padding: 20px 17px;
							font-size: 20px;
							border-radius:8px;
						}
						input::placeholder{
							color:#B4B9BF;
						}
						button{
							display: inline-block;
							text-transform: uppercase;
							font-weight: bold;
							font-size: 19px;
							line-height: 20px;
							padding: 20px 52px;
							border-radius: 50px;
							background: #DD3C61;
						}
		}
</style>
