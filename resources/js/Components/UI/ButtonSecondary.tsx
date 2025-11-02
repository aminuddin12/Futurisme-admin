import { Button, ButtonProps } from '@radix-ui/themes';
const ButtonSecondary = (props: ButtonProps) => (
    <Button variant="outline" color="gray" {...props} />
);
ButtonSecondary.displayName = 'ButtonSecondary';
export default ButtonSecondary;
