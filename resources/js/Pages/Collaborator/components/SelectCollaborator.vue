<template>
    <div class="select-box">
        <div
            v-if="showOptions"
            class="options-container"
        >
            <div
                v-for="(option, index) in options"
                :key="index"
                class="option py-2  pl-2 hover:active cursor-pointer"
                @click.prevent="selectOption(option.value)"
                @mouseover="hoverOption = true"
                @mouseleave="hoverOption = false"
                :class="{'active': (option.value == city) && !hoverOption}"
            >
                <input
                    type="radio"
                    class="radio"
                    id="automoviles"
                    name="category"
                />
                <span
                    @mouseover="hoverOption = true"
                    @mouseleave="hoverOption = false"
                >{{ option.label }}</span>
            </div>
        </div>
        <div
            class="selected w-100 rounded py-2 pr-3  pl-2 inline-block flex justify-content-between"
            @click.prevent="openOptions()"
            :class="{'error-input': error, 'disabled-input': disabled,  'cursor-pointer': !disabled }"
        >
            <span class="inline-block">{{ labelSelect }}</span>
             <i class="fas fa-caret-up text-black inline-block"></i>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            city: 'sevilla',
            showOptions: false,
            options: [
                {label: 'Madrid', value: 'madrid'},
                 {label: 'Barcelona', value: 'barcelona'},
                  {label: 'Sevilla', value: 'sevilla'},
            ],
            hoverOption: false,
        }
    },
    props: {
        error:{
            type: Boolean,
            default: false,
        },
        disabled:{
            type: Boolean,
            default: false,
        },
        textLabel: {
            type: String,
            default: '',
        },
    },
    computed: {
        label () {
            var lb = this.options.find(item => this.city === item.value)
            var text = lb ? lb.label : null
            return text
        },
        labelSelect (){
            return this.label || this.textLabel
        }
    },
    methods: {
        openOptions (){
            if (!this.disabled) {
                this.showOptions = !this.showOptions
                this.hoverOption = false
            } else {
                 this.showOptions = false
                 this.hoverOption = false
            }
        },
        selectOption (value) {
           var op = this.options.find(item => item.value === value)
           this.city = op.value
            this.showOptions = false
        }
    },
}
</script>

<style scoped>
	.select-box{
		display: flex;
		flex-direction: column;
		position: relative;
	}
	.select-box .options-container{
		position: absolute;	
		background-color: #f5f5f5;
		top: 3rem;
		z-index: 90000;
		min-height: 0;
		width: 100%;
		transition: all 0.4;
		border-radius: 8px;
		overflow: hidden;
		order: 1;
	}

	.select-box .options-container .active {
		/*max-height: 240px;
        overflow-y: scroll;*/
        background-color: #aad1e6;
	}

	.select-box .options-container::-webkit-scrollbar {
		width: 8px;
		background: #0d141f;
		border-radius: 0 8px 8px 0;
    }

	.select-box .options-container::-webkit-scrollbar-thumb {
		background: #525861;
		border-radius: 0 8px 8px 0;
	}

	.select-box .selected {
		position: relative;
		order: 0;
        border: solid 1.8px #bfbfbf;
        background-color: #e7f6ff;
        width:100%;
	}

    .select-box .option {
        background-color: #f5f5f5;
        width:100%;
	}
    
    .select-box .error-input{
        border: solid 2.5px red;
    }
    
    .select-box .disabled-input{
        border: solid 2.5px #ebebeb;
		background-color: #ebebeb;
    }

	.select-box .option:hover {
		background-color: #aad1e6;
	}

	.select-box label{
		cursor: pointer;
	}

	.select-box .option .radio{
		display: none;
	}
</style>