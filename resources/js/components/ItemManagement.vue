<template>
  <div>
    <h2>Item Management</h2>
    
    <!-- Display items -->
    <ul>
      <li v-for="item in items" :key="item.id">
        {{ item.name }} - Quantity: {{ item.quantity }}
        <button @click="deleteItem(item.id)">Delete</button>
      </li>
    </ul>
    
    <!-- Form to add new item -->
    <form @submit.prevent="addItem">
      <input v-model="newItemName" type="text" placeholder="Enter item name">
      <input v-model.number="newItemQuantity" type="number" placeholder="Enter quantity">
      <input v-model.number="newItemDescription" type="text" placeholder="Enter description">
      <input v-model.image="newItemImage" type="file" >
      <button type="submit">Add Item</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['inventoryId'],
  data() {
    return {
      items: [],
      newItemName: '',
      newItemQuantity: 0,
      newItemDescription: '',
      newItemImage: '',

    };
  },
  created() {
    this.fetchItems();
  },
  watch: {
    inventoryId() {
      this.fetchItems();
    }
  },
  methods: {
    fetchItems() {
      axios.get(`http://127.0.0.1:8000/api/inventories/${this.inventoryId}/items`)
        .then(response => {
          this.items = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    addItem() {
      axios.post(`http://127.0.0.1:8000/api/inventories/${this.inventoryId}/items`, {
        name: this.newItemName,
        quantity: this.newItemQuantity
      })
        .then(response => {
          this.items.push(response.data);
          this.newItemName = '';
          this.newItemQuantity = 0;
          this.newItemDescription = '';
          this.newItemImage = '';
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteItem(id) {
      axios.delete(`http://127.0.0.1:8000/api/inventories/${this.inventoryId}/items/${id}`)
        .then(() => {
          this.items = this.items.filter(item => item.id !== id);
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
}
</script>