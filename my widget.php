<?php
/**
Plugin Name: My Plugin Name
Description: My Plugin Description
Author: My Name
*/
 
/* Add Function Code Below this line, opening (<?php) tag is already added so no need to worry about that*/
 
/* Stop Adding Function */
 
// Creating custom widget by inheriting WP_Widget Class
class tcb_my_widget extends WP_Widget{
    
    /**
    * Constructer will be used to setup widgets name etc
    */
    public function __construct(){
        parent::__construct(
            /* Base ID for widget options */
            'tcb_my_widget',
            /* Widget Title */
            __('TCB Widget Title', 'tcb_widget_domain'),
            /* Widget Description */
            array('description' => __('Demo Widget for Learning Purpouse', 'tcb_widget_domain'), )
        );
    }
    
    /**
    * Output the content of the widget while generating html
    * @parameter array $args
    */
    public function widget($args, $instance){
        // outputs the content of the widget 
        echo $args['before_widget'];
        if(!empty($instance['title'])){
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        echo $args['after_widget'];
    }
    
    /**
    * Outputs the options form on admin
    * @param array $instance holds the widgets options
    */
    public function form($instance){        
        if (isset( $instance['title'] )){
            $title = $instance['title'];
        } else {
            $title = "";
        }
        // Output the fields to admin widgett area here
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }
    
    /**
    * Processing form option when hit save
    *
    * @parameter array $new_instance holds the new options
    * @parameter array $old_instance holds the old options
    */
    public function update( $new_instance, $old_instance){
        //save widget options
        $instance = $old_instance;
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
    
}

// register tcb_my_widget
function register_tcb_widget(){
    register_widget('tcb_my_widget');
}
// Action hook to Add Widget
add_action( 'widgets_init', 'register_tcb_widget' );

?>