<template>
  <div>
    <h2>Inventory Management</h2>
    
    <!-- Display inventories -->
    <ul>
      <li v-for="inventory in inventories" :key="inventory.id">
        {{ inventory.name }}
        <button @click="deleteInventory(inventory.id)">Delete</button>
      </li>
    </ul>
    
    <!-- Form to add new inventory -->
    <form @submit.prevent="addInventory">
      <input v-model="newInventoryName" type="text" placeholder="Enter inventory name">
      <button type="submit">Add Inventory</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      inventories: [],
      newInventoryName: ''
    };
  },
  created() {
    this.fetchInventories();
  },
  methods: {
    fetchInventories() {
      axios.get('http://127.0.0.1:8000/api/inventories')
        .then(response => {
          this.inventories = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    addInventory() {
      axios.post('http://127.0.0.1:8000/api/inventories', { name: this.newInventoryName })
        .then(response => {
          this.inventories.push(response.data);
          this.newInventoryName = '';
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteInventory(id) {
      axios.delete(`http://127.0.0.1:8000/api/inventories/${id}`)
        .then(() => {
          this.inventories = this.inventories.filter(inventory => inventory.id !== id);
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
}
</script>