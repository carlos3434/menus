<modal :show.sync="showModal">

  <div slot="modal-header" class="modal-header">
    <button type="button" class="close" @click="showModal = false"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">@{{tituloModal}}</h4>
  </div>

  <div slot="modal-body" class="modal-body">

    <div class="alert alert-danger" v-if="!isValid">
        <ul>
            <li v-show="!validation.name">Name field is required.</li>
            <li v-show="!validation.email">Input a valid email address.</li>
            <li v-show="!validation.address">Address field is required.</li>
        </ul>
    </div>
    <form action="#" @submit.prevent="accionModal">
    
        <input v-model="newUser.id" type="hidden" id="id" name="id">
        <div class="form-group">
            <label for="name">Name:</label>
            <input v-model="newUser.name" type="text" id="name" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input v-model="newUser.email" type="text" id="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input v-model="newUser.address" type="text" id="address" name="address" class="form-control">
        </div>

        <div class="form-group">
            <div  class="modal-footer">
                <button type="button" class="btn btn-default" @click="showModal = false">Close</button>
                <button :disabled="!isValid" class="btn btn-primary" type="submit">Save</button>
            </div>

        </div>

    </form>

  </div>
  <div v-if="false" slot="modal-footer" class="modal-footer"></div>

</modal>