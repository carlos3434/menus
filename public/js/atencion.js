$(document).ready(function() {
    activarMesas();

    $('.stats-btn').on("click",function(){
        activarPlatos();
    });
    $('#verPlatos').on("click",function(){
        activarPedidos();
    });
    $('#cobrar').on("click",function(){
        activarPedidos();
    });
    $('#volverCobrar').on("click",function(){
        activarMesas();
    });
    $('#volverVerPlatos').on("click",function(){
        activarMesas();
    });
    //pedido
    $('#volverPedido').on("click",function(){
        activarPlatos();
    });
    $('#pedido').on("click",function(){
        alert("gracias por su preferencia");
    });
});

activarMesas=function(){
    $("#mesas").css("display","");
    $("#platos").css("display","none");
    $("#pedidos").css("display","none");
};
activarPlatos=function(){
    $("#mesas").css("display","none");
    $("#platos").css("display","");
    $("#pedidos").css("display","none");
};
activarPedidos=function(){
    $("#mesas").css("display","none");
    $("#platos").css("display","none");
    $("#pedidos").css("display","");
};


var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

var vm = new Vue({
    http: {
      root: '/root',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },
    el: '#AtencionController',
    components: {
        'v-select': VueStrap.select,
        'v-option': VueStrap.option,
        'checkbox-group': VueStrap.checkboxGroup,
        'checkbox': VueStrap.checkboxBtn,
        'datepicker': VueStrap.datepicker,
        'alert': VueStrap.alert,
        'modal': VueStrap.modal,
        'aside': VueStrap.aside,
        'panel': VueStrap.panel,
        'spinner': VueStrap.spinner,
    },
    data: {
        loaded: false,
        newUser: {
            id: '',
            name: '',
            email: '',
            address: ''
        },
        showModal: false,
        edit: false,
        tituloModal:'',
        success: false,
        danger: false,
        msj: ''
    },
    methods: {
        accionModal:function(){
            if (this.edit)
                this.EditUser(this.newUser.id);
            else
                this.AddNewUser();
        },
        EditNewUser: function () {// cargar modal para añadir usuario
            this.showModal=true;
            this.edit = false;
            this.tituloModal = 'Nuevo Usuario';
            this.newUser = { name:'', email:'', address:'' };
        },
        ShowUser: function (id) { //mostrar modal para editar
            this.showModal=true;
            this.edit = true;
            this.tituloModal = 'Editar Usuario';
            this.$http.get('/api/users/' + id, function (data) {
                this.newUser.id = data.id;
                this.newUser.name = data.name;
                this.newUser.email = data.email;
                this.newUser.address = data.address;
            });
        },
        AddNewUser: function () { //añadir un usuario
            this.loaded=true;
            var user = this.newUser;
            this.newUser = { name:'', email:'', address:'' };
            this.$http.post('/api/users', user,  function (data) {
                this.loaded=false;
                this.showModal=false;
                vm.fetchUser();
                msj=' usuario nuevo creado correctamente.';
                this.ShowMensaje(msj, 5, true, false);
            }).error(function(errors) {
                this.loaded=false;
                this.ShowMensaje(errors, 5, false, true);
            });
            self = this;
            this.success = true;
        },
        fetchUser: function () { //consultar todos los usuarios
            this.$http.get('/api/users', function (data) {
                this.$set('users', data);
            });
        },
        RemoveUser: function (id) { //remover 
            var ConfirmBox = confirm("Are you sure, you want to delete this User?");
            if(ConfirmBox) {
                this.$http.delete('/api/users/' + id, function (data) {
                    msj=' usuario eliminado correctamente.';
                    this.ShowMensaje(msj, 5, true, false);
                }).error(function(errors) {
                    this.ShowMensaje(errors, 5, false, true);
                });
            }
            this.fetchUser();
        },
        EditUser: function (id) { // enviar a laravel para guardar edicion
            this.loaded=true;
            var user = this.newUser;
            this.newUser = { id: '', name: '', email: '', address: ''};
            this.$http.patch('/api/users/' + id, user, function (data) {
                this.loaded=false;
                this.showModal=false;
                vm.fetchUser();
                msj=' usuario modificado correctamente.';
                this.ShowMensaje(msj, 5, true, false);
            }).error(function(errors) {
                this.loaded=false;
                this.ShowMensaje(errors, 5, false, true);
            });
            this.fetchUser();
            this.edit = false;
        },
        ShowMensaje: function(msj, time, success, danger) {
            this.msj=msj;
            self = this;
            this.danger = danger;
            this.success = success;
            setTimeout(function () {
                self.danger = false;
                self.success = false;
            }, time*1000);
        }
    },
    computed: {
        validation: function () {
            return {
                name: !!this.newUser.name.trim(),
                email: emailRE.test(this.newUser.email),
                address: !!this.newUser.address.trim()
            };
        },
        isValid: function () {
            var validation = this.validation;
            return Object.keys(validation).every(function (key) {
                return validation[key];
            });
        }
    },
    ready: function () {
        //this.fetchUser();
    }
});
