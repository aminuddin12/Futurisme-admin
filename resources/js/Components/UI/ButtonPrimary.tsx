import { Button, ButtonProps } from '@radix-ui/themes';

const ButtonPrimary = (props: ButtonProps) => (
    <Button color="blue" {...props} />
);
ButtonPrimary.displayName = 'ButtonPrimary';
export default ButtonPrimary;
