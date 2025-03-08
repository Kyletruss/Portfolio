import { forwardRef, ReactNode, ComponentProps } from "react";
import { Box } from "@chakra-ui/react"; // Ensure Chakra UI imports are correct

// Replace 'ChakraField' with a proper component if it exists or create a custom wrapper
const ChakraField = {
  Root: Box, // Example: Replace with actual Chakra UI field container
  Label: Box, // Example: Replace with actual label component
  RequiredIndicator: ({ fallback }: { fallback?: ReactNode }) => <span>{fallback || "*"}</span>,
  HelperText: Box, // Example: Replace with actual helper text component
  ErrorText: Box, // Example: Replace with actual error text component
};

export interface FieldProps extends Omit<ComponentProps<typeof ChakraField.Root>, "label"> {
  label?: ReactNode;
  helperText?: ReactNode;
  errorText?: ReactNode;
  optionalText?: ReactNode;
}

export const Field = forwardRef<HTMLDivElement, FieldProps>(function Field(props, ref) {
  const { label, children, helperText, errorText, optionalText, ...rest } = props;

  return (
    <ChakraField.Root ref={ref} {...rest}>
      {label && (
        <ChakraField.Label>
          {label}
          <ChakraField.RequiredIndicator fallback={optionalText} />
        </ChakraField.Label>
      )}
      {children}
      {helperText && <ChakraField.HelperText>{helperText}</ChakraField.HelperText>}
      {errorText && <ChakraField.ErrorText>{errorText}</ChakraField.ErrorText>}
    </ChakraField.Root>
  );
});
