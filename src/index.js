import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/block-editor';

registerBlockType( 'autotype-block/autotype-block', {
    title: 'AutoType',
    icon: 'universal-access-alt',
    category: 'design',
    example: {},
    attributes: {
      content: {
				type: 'array',
				source: 'children',
				selector: 'p'
			},
    },
    edit(props) {
      let autotype_content = props.attributes.content;

      function onChangeContent ( autotype_content ) {
              props.setAttributes({content: autotype_content})
      }

        return (
          <RichText
            className={props.className}
            onChange={onChangeContent}
            value={autotype_content}
            placeholder="Enter your content"
            multiline="p"
            />
        );
    },
    save(props) {

      return (
        <div>
        <div id="typed-strings">
        {props.attributes.content}
        </div>
        <span id="typed"></span>
        </div>
      );

    },
} );
