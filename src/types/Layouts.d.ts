declare module '@/Layouts/PageLayout' {
  import React from 'react';
  // コンポーネントの型
  const PageLayout: React.FC<PageLayoutProps>;
  export default PageLayout;
}


declare module '@/Layouts/GuestLayout' {
  import React from 'react';
  // コンポーネントの型
  const GuestLayout: React.FC<GuestLayoutProps>;
  export default GuestLayout;
}


declare module '@/Layouts/AuthenticatedLayout' {
  import React from 'react';
  // コンポーネントの型
  const AuthenticatedLayout: React.FC<AuthenticatedLayoutProps>;
  export default AuthenticatedLayout;
}