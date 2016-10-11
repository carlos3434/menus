var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

var vm = new Vue({
    http: {
      root: '/api/users',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },
    el: '#UserController',
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
        users:{
            id: '',
            name: '',
            email: '',
            address: ''
        },
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
            this.$http.get( ''+id, function (data) {
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
                this.showModal=false;
                this.loaded=false;
                app.$broadcast('vuetable:refresh');
                //vm.fetchUser();
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
            this.$http.get('', function (data) {
                this.$set('users', data);
            });
        },
        RemoveUser: function (id) { //remover 
            var ConfirmBox = confirm("Are you sure, you want to delete this User?");
            if(ConfirmBox) {
                this.$http.delete( ''+id, function (data) {
                    app.$broadcast('vuetable:refresh');
                    msj=' usuario eliminado correctamente.';
                    this.ShowMensaje(msj, 5, true, false);
                }).error(function(errors) {
                    this.ShowMensaje(errors, 5, false, true);
                });
            }
            //this.fetchUser();
        },
        EditUser: function (id) { // enviar a laravel para guardar edicion
            this.loaded=true;
            var user = this.newUser;
            this.newUser = { id: '', name: '', email: '', address: ''};
            this.$http.patch( ''+id, user, function (data) {
                this.showModal=false;
                this.loaded=false;
                //vm.fetchUser();
                app.$broadcast('vuetable:refresh');
                msj=' usuario modificado correctamente.';
                this.ShowMensaje(msj, 5, true, false);
            }).error(function(errors) {
                this.loaded=false;
                this.ShowMensaje(errors, 5, false, true);
            });
            //this.fetchUser();
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
var E_SERVER_ERROR = 'Error communicating with the server';

// fields definition
var tableColumns = [
    {
        name: 'id',
        title: '',
        dataClass: 'text-center',
        callback: 'showDetailRow'
    },
    {
        name: 'name',
        sortField: 'name',
    },
    {
        name: 'email',
        sortField: 'email',
    },
    {
        name: 'nickname',
        sortField: 'nickname',
        callback: 'allCap'
    },
    {
        name: 'birthdate',
        sortField: 'birthdate',
        callback: 'formatDate|D/MM/Y'
    },
    {
        name: 'gender',
        sortField: 'gender',
        titleClass: 'text-center',
        dataClass: 'text-center',
        callback: 'gender'
    },
    {
        name: '__component:custom-action',
        title: "Component",
        titleClass: 'center aligned',
        dataClass: 'custom-action center aligned',
    }/*,
    {
        name: '__actions',
        dataClass: 'text-center',
    }*/
];

Vue.config.debug = true;

    



Vue.component('custom-action', {
    template: [
        /*'<div>',
            '<button @click="itemAction(\'view-item\', rowData)"><i class="glyphicon glyphicon-zoom-in"></i></button>',
            '<button @click="itemAction(\'edit-item\', rowData)"><i class="glyphicon glyphicon-pencil"></i></button>',
            '<button @click="itemAction(\'delete-item\', rowData)"><i class="glyphicon glyphicon-remove"></i></button>',
        '</div>'*/
        '<td class="vuetable-actions text-center">',
        '<button @click="itemAction(\'view-item\', rowData)" title="View"  data-placement="left" class="btn btn-info">',
            '<i class="glyphicon glyphicon-zoom-in"></i> ',
        '</button>',
        '<button @click="itemAction(\'edit-item\', rowData)" title="Edit"  data-placement="top" class="btn btn-warning" @click="ShowUser(rowData.id)">',
            '<i class="glyphicon glyphicon-pencil"></i> ',
        '</button>',
        '<button @click="itemAction(\'delete-item\', rowData)" title="Delete"  data-placement="right" class="btn btn-danger" @click="ShowUser(rowData.id)">',
            '<i class="glyphicon glyphicon-remove"></i> ',
        '</button>',
        '</td>'
    ].join(''),
    props: {
        rowData: {
            type: Object,
            required: true
        }
    },
    
    methods: {
        itemAction: function(action, data) {
            if (action == 'view-item') {
                sweetAlert(action, data.name);
            } else if (action == 'edit-item') {
                vm.ShowUser(data.id);
            } else if (action == 'delete-item') {
                vm.RemoveUser(data.id);
            }
            //sweetAlert('custom-action: ' + action, data.name);
        },
        onClick: function(event) {
            console.log('custom-action: on-click', event.target);
        },
        onDoubleClick: function(event) {
            console.log('custom-action: on-dblclick', event.target);
        },
    }
});

Vue.component('my-detail-row', {
    template: [
        '<div class="detail-row ui form" @click="onClick($event)">',
            '<div class="inline field">',
                '<label>Name: </label>',
                '<span>@{{rowData.name}}</span>',
            '</div>',
            '<div class="inline field">',
                '<label>Email: </label>',
                '<span>@{{rowData.email}}</span>',
            '</div>',
            '<div class="inline field">',
                '<label>Nickname: </label>',
                '<span>@{{rowData.nickname}}</span>',
            '</div>',
            '<div class="inline field">',
                '<label>Birthdate: </label>',
                '<span>@{{rowData.birthdate}}</span>',
            '</div>',
            '<div class="inline field">',
                '<label>Gender: </label>',
                '<span>@{{rowData.gender}}</span>',
            '</div>',
        '</div>',
    ].join(''),
    props: {
        rowData: {
            type: Object,
            required: true
        }
    },
    methods: {
        onClick: function(event) {
            console.log('my-detail-row: on-click');
        }
    },
});

var app=new Vue({
    el: '#app',
    data: {
        searchFor: '',
        fields: tableColumns,
        sortOrder: [{
            field: 'name',
            direction: 'asc'
        }],
        multiSort: true,
        perPage: 10,
        paginationComponent: 'vuetable-pagination',
        //paginationInfoTemplate: 'แสดง {from} ถึง {to} จากทั้งหมด {total} รายการ',
        paginationInfoTemplate: 'Displaying {from} to {to} of {total} items',
                
        itemActions: [
            { name: 'view-item', label: '', icon: 'glyphicon glyphicon-zoom-in', class: 'btn btn-info', extra: {'title': 'View', 'data-toggle':"tooltip", 'data-placement': "left"} },
            { name: 'edit-item', label: '', icon: 'glyphicon glyphicon-pencil', class: 'btn btn-warning', extra: {title: 'Edit', 'data-toggle':"tooltip", 'data-placement': "top"} },
            { name: 'delete-item', label: '', icon: 'glyphicon glyphicon-remove', class: 'btn btn-danger', extra: {title: 'Delete', 'data-toggle':"tooltip", 'data-placement': "right" } }
        ],
        moreParams: [],
    },
    watch: {
        'perPage': function(val, oldVal) {
            this.$broadcast('vuetable:refresh');
        },
        'paginationComponent': function(val, oldVal) {
            this.$broadcast('vuetable:load-success', this.$refs.vuetable.tablePagination);
            this.paginationConfig(this.paginationComponent);
        }
    },
    methods: {
        /**
         * Callback functions
         */
        allCap: function(value) {
            return value.toUpperCase();
        },
        gender: function(value) {
          return value == 'M'
            ? '<span class="label label-info"><i class="glyphicon glyphicon-star"></i> Male</span>'
            : '<span class="label label-success"><i class="glyphicon glyphicon-heart"></i> Female</span>';
        },

        formatDate: function(value, fmt) {
            if (value == null) return '';
            fmt = (typeof fmt == 'undefined') ? 'D MMM YYYY' : fmt;
            return moment(value, 'YYYY-MM-DD').format(fmt);
        },
        showDetailRow: function(value) {
            var icon = this.$refs.vuetable.isVisibleDetailRow(value) ? 'glyphicon glyphicon-minus-sign' : 'glyphicon glyphicon-plus-sign';
            return [
                '<a class="show-detail-row">',
                    '<i class="' + icon + '"></i>',
                '</a>'
            ].join('');
        },
        /**
         * Other functions
         */
        setFilter: function() {
            this.moreParams = [
                'filter=' + this.searchFor
            ];
            this.$nextTick(function() {
                this.$broadcast('vuetable:refresh');
            });
        },
        resetFilter: function() {
            this.searchFor = '';
            this.setFilter();
        },
        preg_quote: function( str ) {
            // http://kevin.vanzonneveld.net
            // +   original by: booeyOH
            // +   improved by: Ates Goral (http://magnetiq.com)
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   bugfixed by: Onno Marsman
            // *     example 1: preg_quote("$40");
            // *     returns 1: '\$40'
            // *     example 2: preg_quote("*RRRING* Hello?");
            // *     returns 2: '\*RRRING\* Hello\?'
            // *     example 3: preg_quote("\\.+*?[^]$(){}=!<>|:");
            // *     returns 3: '\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:'

            return (str+'').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
        },
        highlight: function(needle, haystack) {
            return haystack.replace(
                new RegExp('(' + this.preg_quote(needle) + ')', 'ig'),
                '<span class="highlight">$1</span>'
            );
        },
        makeDetailRow: function(data) {
            return [
                '<td colspan="7">',
                    '<div class="detail-row">',
                        '<div class="form-group">',
                            '<label>Name: </label>',
                            '<span>' + data.name + '</span>',
                        '</div>',
                        '<div class="form-group">',
                            '<label>Email: </label>',
                            '<span>' + data.email + '</span>',
                        '</div>',
                        '<div class="form-group">',
                            '<label>Nickname: </label>',
                            '<span>' + data.nickname + '</span>',
                        '</div>',
                        '<div class="form-group">',
                            '<label>Birthdate: </label>',
                            '<span>' + data.birthdate + '</span>',
                        '</div>',
                        '<div class="form-group">',
                            '<label>Gender: </label>',
                            '<span>' + data.gender + '</span>',
                        '</div>',
                    '</div>',
                '</td>'
            ].join('');
        },
        rowClassCB: function(data, index) {
            return (index % 2) === 0 ? 'positive' : '';
        },
        paginationConfig: function(componentName) {
            console.log('paginationConfig: ', componentName);
            if (componentName == 'vuetable-pagination') {
                this.$broadcast('vuetable-pagination:set-options', {
                    wrapperClass: 'pagination',
                    icons: { first: '', prev: '', next: '', last: ''},
                    activeClass: 'active',
                    linkClass: 'btn btn-default',
                    pageClass: 'btn btn-default'
                });
            }
            if (componentName == 'vuetable-pagination-dropdown') {
                this.$broadcast('vuetable-pagination:set-options', {
                    wrapperClass: 'form-inline',
                    icons: { prev: 'glyphicon glyphicon-chevron-left', next: 'glyphicon glyphicon-chevron-right' },
                    dropdownClass: 'form-control'
                });
            }
        },
        // -------------------------------------------------------------------------------------------
        // You can change how sort params string is constructed by overriding getSortParam() like this
        // -------------------------------------------------------------------------------------------
        // getSortParam: function(sortOrder) {
        //     console.log('parent getSortParam:', JSON.stringify(sortOrder))
        //     return sortOrder.map(function(sort) {
        //         return (sort.direction === 'desc' ? '+' : '') + sort.field
        //     }).join(',')
        // }
    },
    events: {
        'vuetable:row-changed': function(data) {
            console.log('row-changed:', data.name);
        },
        'vuetable:row-clicked': function(data, event) {
            console.log('row-clicked:', data.name);
        },
        'vuetable:cell-clicked': function(data, field, event) {
            console.log('cell-clicked:', field.name);
            if (field.name !== '__actions') {
                this.$broadcast('vuetable:toggle-detail', data.id);
            }
        },
        'vuetable:action': function(action, data) {
            console.log('vuetable:action', action, data);
            if (action == 'view-item') {


                sweetAlert(action, data.name);
            } else if (action == 'edit-item') {


                sweetAlert(action, data.name);
            } else if (action == 'delete-item') {
                sweetAlert(action, data.name);
            }
        },
        'vuetable:load-success': function(response) {
            var data = response.data.data;
            //
            vm.users=data;
            console.log(data);
            if (this.searchFor !== '') {
                for (n in data) {
                    data[n].name = this.highlight(this.searchFor, data[n].name);
                    data[n].email = this.highlight(this.searchFor, data[n].email);
                }
            }
        },
        'vuetable:load-error': function(response) {
            if (response.status == 400) {
                sweetAlert('Something\'s Wrong!', response.data.message, 'error');
            } else {
                sweetAlert('Oops', E_SERVER_ERROR, 'error');
            }
        }
    }
});
