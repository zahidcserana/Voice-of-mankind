<!-- Search Reform Idea -->
<div class="col_full">
    <div class="stories-right-title">
        <h3> <span>Search Reform Idea</span></h3>
    </div>
    <div class="stories-searchbar">
	    <?php
	    echo $this->Form->create('ReformIdea', ['method' => 'post','url' => ['action' => 'search']]);
	    echo $this->Form->input('search', ['label' => false, 'controller' => 'ReformIdeas', 'action' => 'search',
	        'class' => 'form-control input-lg search-input', 'placeholder' => 'Search here...']);
	    ?>
	</div>
</div>
