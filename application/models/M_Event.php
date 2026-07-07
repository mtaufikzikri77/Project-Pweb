<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Event extends CI_Model {
    
    public function get_main_event() {
        return $this->db->get_where('events', array('is_main_event' => 1))->row();
    }

    public function get_carousel_events() {
        $this->db->select('events.*, categories.name as category_name');
        $this->db->from('events');
        $this->db->join('event_category', 'events.id = event_category.event_id', 'left');
        $this->db->join('categories', 'event_category.category_id = categories.id', 'left');
        $this->db->where('is_main_event', 0);
        $this->db->order_by('events.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_detail($id) {
        return $this->db->get_where('events', array('id' => $id))->row();
    }

    public function insert_transaction($data) {
        return $this->db->insert('transaction_logs', $data);
    }

    public function decrease_quota($event_id, $qty) {
        $this->db->set('quota', 'quota - ' . (int)$qty, FALSE);
        $this->db->where('id', $event_id);
        return $this->db->update('events');
    }

    public function get_categories() {
        return $this->db->get('categories')->result();
    }

    public function get_unique_locations() {
        $this->db->select('location');
        $this->db->distinct();
        $this->db->from('events');
        $this->db->where('location IS NOT NULL');
        $this->db->where('location !=', '');
        return $this->db->get()->result();
    }

    public function get_filtered_events($category = '', $location = '', $sort = '', $tersedia = '') {
        $this->db->select('events.*, categories.name as category_name');
        $this->db->from('events');
        $this->db->join('event_category', 'events.id = event_category.event_id', 'left');
        $this->db->join('categories', 'event_category.category_id = categories.id', 'left');

        if (!empty($category) && $category != 'All') {
            $this->db->where('categories.name', $category);
        }
        if (!empty($location) && $location != 'All') {
            $this->db->where('events.location', $location);
        }
        if ($tersedia == '1') {
            $this->db->where('events.quota >', 0);
        }

        if ($sort == 'termurah') {
            $this->db->order_by('events.price', 'ASC');
        } elseif ($sort == 'termahal') {
            $this->db->order_by('events.price', 'DESC');
        } else {
            $this->db->order_by('events.id', 'DESC');
        }

        return $this->db->get()->result();
    }
}